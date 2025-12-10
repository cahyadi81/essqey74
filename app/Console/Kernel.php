<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


use App\Console\Commands\NotifStart;
use App\Console\Commands\autoLogout;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
       NotifStart::class,
       autoLogout::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('NotifStart')
        // ->everyFiveMinutes()
        // ->hourly()
        ->dailyAt('06:00')
        // ->everyMinute()
        ->appendOutputTo(storage_path('logs/DinasApprovalNotif.log'));

        $schedule->command('autologout')
        // ->dailyAt('13:00')
        // ->everyMinute()
        ->hourly()
        ->appendOutputTo(storage_path('logs/logoutLogs.log'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        $this->load(__DIR__.'/Commands/NotifStart');
        $this->load(__DIR__.'/Commands/autoLogout');

        require base_path('routes/console.php');
    }
}
