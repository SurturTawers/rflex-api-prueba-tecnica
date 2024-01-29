<?php

namespace App\Console;

use App\Console\Commands\StoreCurrencies;
use App\Console\Commands\StoreDolarHistory;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('store:currencies')->everyFourHours();
        $schedule->command('store:dolar 2023 --summary')->hourly();
        $schedule->command('store:dolar 2024 --summary')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
