<?php

namespace App\Console\Commands;

use App\Http\Controllers\CurrenciesController;
use App\Services\CurrencyServices;
use Illuminate\Console\Command;

class StoreDolarHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:dolar {periodo?} {--S|summary}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consulta a la API de mindicador para obtener el historial de valores del dolar para un periodo determinado';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CurrencyServices $currencyServices)
    {
        $periodo = $this->argument('periodo');
        if(!$periodo) $periodo = date("Y");

        $currencyServices->storeDolarHistory($periodo);

        if($this->option('summary')) $currencyServices->storeCurrenciesSummary();

        return Command::SUCCESS;
    }
}
