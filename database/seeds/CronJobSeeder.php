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
              'command'  => 'vrgame',
              'param'    => null,
              'schedule' => '*/1 * * * *',
              'status'   => 1,
              'remarks'  => '每分钟抓取VR游戏记录里未拉取三方数据的记录并更新游戏状态',
             ],
            ],
        );
    }
}
