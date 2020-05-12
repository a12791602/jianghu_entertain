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
            //有argument的情况
            if (is_array($scheduleItem['argument']) && !empty($scheduleItem['argument'])) {
                //有argument和option  需要合并
                if (is_array($scheduleItem['option']) && !empty($scheduleItem['option'])) {
                    $params = array_merge($scheduleItem['argument'], $scheduleItem['option']);
                } else {
                    $params = $scheduleItem['argument'];
                }
                $schedule->command($scheduleItem['command'], [$params])->cron($scheduleItem['schedule']);
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
