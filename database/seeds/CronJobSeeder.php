<?php

use App\Models\DeveloperUsage\TaskScheduling\CronJob;
use Illuminate\Database\Seeder;

/**
 * Class CronJobSeeder
 */
class CronJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        CronJob::insert(
            [
             [
              'command'  => 'gamelog',
              'param'    => null,
              'schedule' => '*/1 * * * *',
              'status'   => 1,
              'remarks'  => '每分钟抓取三方游戏数据的记录',
             ],
            ],
        );
    }
}