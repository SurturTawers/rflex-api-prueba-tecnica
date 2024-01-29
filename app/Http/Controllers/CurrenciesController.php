<?php

namespace App\Http\Controllers;

use App\Services\CurrencyServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CurrenciesController extends Controller
{

    function getCurrencyValues (Request $request, CurrencyServices $currencyServices){
        $currency = $request->route()->parameter('currency');

        $fecha_desde = $request->query('fecha_desde');
        $fecha_hasta = $request->query('fecha_hasta');

        if (!isset($fecha_desde) || !isset($fecha_hasta)){
            return response("ERROR DE CONSULTA: Faltan parametros", 400);
        }

        $history = [];
        switch ($currency){
            case 'dolar':
                $history = $currencyServices->getDolarHistory($fecha_desde, $fecha_hasta);
                break;
            default:
                return response("ERROR DE CONSULTA: ${currency} no existe en nuestros registros",400);
        }

        return response()->json($history, 200);
    }


    function getDates(Request $request, CurrencyServices $currencyServices){
        $currency = $request->route()->parameter('currency');

        $dates = [];
        switch ($currency){
            case 'dolar':
                $dates = $currencyServices->getAvailableDolarDates();
                break;
            default:
                return response("ERROR DE CONSULTA: ${currency} no existe en nuestros registros",400);
        }

        return response()->json($dates,200);

    }

    function getCurrenciesSummary(Request $request, CurrencyServices $currencyServices){
        $summary = $currencyServices->getCurrenciesSummaries();
        return response()->json($summary,200);
    }

    function getAvailableCurrencies(Request $request, CurrencyServices $currencyServices){
        $currencies = $currencyServices->getAvailableCurrencies();
        return response()->json($currencies,200);
    }

}
