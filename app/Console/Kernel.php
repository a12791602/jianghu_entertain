<?php

namespace App\Console;

use App\Models\Systems\StaticResource;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package App\Console
 */
class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];//currently blanket for later insertion

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule Schedule.
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $path         = StaticResource::getSchedulePath();
        $scheduleJson = StaticResource::getResource(config('filesystems.default'), $path);
        $scheduleArr  = json_decode($scheduleJson, true);
        if (!is_array($scheduleArr) || empty($scheduleArr)) {
            return;
        }

        foreach ($scheduleArr as $scheduleItem) {
            if (is_array($scheduleItem['param']) && !empty($scheduleItem['param'])) {
                //有argument的情况
                $schedule->command($scheduleItem['command'], [$scheduleItem['param']])->cron($scheduleItem['schedule']);
            } else {
                //没有argument的情况
                $schedule->command($scheduleItem['command'])->cron($scheduleItem['schedule']);
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
