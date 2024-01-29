<?php

namespace App\Console\Commands;

use App\Services\CurrencyServices;
use Illuminate\Console\Command;

class StoreCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:currencies {--S|summary}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inicializa las monedas disponibles en la BD';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CurrencyServices $currencyServices)
    {
        $currencyServices->storeAvailableCurrencies();
        if($this->option('summary')) $currencyServices->storeCurrenciesSummary();
        return Command::SUCCESS;
    }
}
