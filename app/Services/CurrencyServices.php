<?php

namespace App\Services;

use App\Models\Currencies;
use App\Models\CurrenciesSummary;
use App\Models\DolarHistory;
use Carbon\Carbon;
use Database\Seeders\CurrenciesSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyServices
{

    private function getCurrencyHistoryFromApi($currency, $periodo){
        $apiUrl = "https://mindicador.cl/api/$currency/$periodo";

        $response = Http::get($apiUrl);
        $data = json_decode($response);

        return $data->serie;
    }

    private function getCurrencySummaryFromApi(){
        $apiUrl = "https://mindicador.cl/api";

        $response = Http::get($apiUrl);
        if($response->failed()) return false;

        $data = json_decode($response,true);
        return $data;
    }

    public function storeCurrenciesSummary(){
        $apiSummary = $this->getCurrencySummaryFromApi();
        $availableCurrencies = $this->getAvailableCurrencies();
        foreach ($availableCurrencies as $currency){
            if(!$apiSummary){
                $mostRecentValue = DB::table($currency->codigo.'_history')
                    ->whereYear('fecha','=', date("Y"))
                    ->latest('fecha')
                    ->first();
            }else{
                $mostRecentValue = (object) $apiSummary[$currency->codigo];
                $mostRecentValue->fecha = explode('T',$mostRecentValue->fecha)[0];
            }
             if($mostRecentValue) DB::table('currencies_summary')
                ->upsert(['codigo'=>$mostRecentValue->codigo,'fecha'=>$mostRecentValue->fecha, 'valor'=>$mostRecentValue->valor],['codigo']);
        }
    }

    public function getCurrenciesSummaries() {
        $availableCurrencies = $this->getAvailableCurrencies();
        $summary = CurrenciesSummary::whereIn('codigo',$availableCurrencies)->get();
        return $summary;

    }

    public function storeDolarHistory($periodo){
        $history = $this->getCurrencyHistoryFromApi('dolar', $periodo);
        $mostRecentRecordDate = DolarHistory::whereYear('fecha','=',$periodo)->max('fecha');

        if($mostRecentRecordDate){
            $mostRecentDate = Carbon::createFromDate($mostRecentRecordDate);
            foreach($history as $record){
                $recordDate = Carbon::createFromDate(explode("T",$record->fecha)[0]);
                if ($recordDate->lessThanOrEqualTo($mostRecentDate)) break;
                DolarHistory::create([
                    'codigo'=>'dolar',
                    'fecha'=>$recordDate,
                    'valor' => $record->valor
                ]);
            }
        }else{
            foreach ($history as $record){
                DolarHistory::create([
                    'codigo'=>'dolar',
                    'fecha'=>explode("T",$record->fecha)[0],
                    'valor' => $record->valor
                ]);
            }
        }

    }

    public function storeAvailableCurrencies(){
        $hasRecords = Currencies::all()->count();
        if(!$hasRecords) Artisan::call('db:seed');
    }

    public function getDolarHistory($fecha_desde, $fecha_hasta){
        $dolarValues = DolarHistory::whereBetween('fecha',[$fecha_desde, $fecha_hasta])->orderBy('fecha','desc')->get();
        return $dolarValues;
    }

    public function getAvailableDolarDates(){
        $availableDates = DolarHistory::orderBy('fecha','desc')->select('id','fecha')->get();
        return $availableDates;
    }

    public function getAvailableCurrencies(){
        $availableCurrencies = Currencies::where('is_active',true)->select('codigo')->get();
        return $availableCurrencies;
    }

}
