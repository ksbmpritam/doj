<?php

namespace App\Console;

use App\Helpers\NotificationHelper; // Make sure to import your helper
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
        $schedule->command('restaurants:update-status-by-datetime')->everyMinute();

        $schedule->call(function () {
            NotificationHelper::get_restaurant(); 
            Log::warning("cron working resturant not");
        })->everyMinute();
        
        $schedule->call(function () {
            Log::warning("cron working self order");
            NotificationHelper::getSelfOrder();
        })->everyMinute();

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
