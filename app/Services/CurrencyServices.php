<?php

namespace App\Services;

use App\Models\DolarHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyServices
{

    public function getCurrencyHistoryFromApi($currency, $periodo){
        $apiUrl = "https://mindicador.cl/api/$currency/$periodo";

        $response = Http::get($apiUrl);
        $data = json_decode($response);

        return $data->serie;
    }

    public function storeDolarHistory($periodo){
        $history = $this->getCurrencyHistoryFromApi('dolar', $periodo);
        $mostRecentRecordDate = DolarHistory::whereYear('fecha','=',$periodo)->max('fecha');

        if($mostRecentRecordDate){
            $mostRecentDate = Carbon::createFromDate($mostRecentRecordDate);
            foreach($history as $record){
                $record_date = Carbon::createFromDate(explode("T",$record->fecha)[0]);
                if ($record_date->lessThanOrEqualTo($mostRecentDate)) break;
                DolarHistory::create([
                    'codigo'=>'dolar',
                    'fecha'=>$record_date,
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

    public function getDolarHistory($fecha_desde, $fecha_hasta){
        $dolar_values = DolarHistory::whereBetween('fecha',[$fecha_desde, $fecha_hasta])->get();
        return $dolar_values;
    }

}
