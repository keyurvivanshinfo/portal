<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// model
use App\Models\forgotPassword;

// jobs
use App\Jobs\SendAllUserData;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->exec('php artisan queue:listen')->everyMinute();

        // delete  expired forgot password request after 1 Day
       $schedule->call(function () {
        forgotPassword::where('created_at', '<=', now()->subDays(1))->delete();
       })->daily();


       $schedule->job(new SendAllUserData)->daily();

    //    Everyday send the new registered user in last 24 hours data to the ADMIN 
       $schedule->exec('php artisan app:new-registered-users')->daily();




    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
