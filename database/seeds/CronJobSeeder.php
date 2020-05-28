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
              'schedule' => '*/1 * * * *',
              'argument' => null,
              'option'   => null,
              'status'   => 1,
              'remarks'  => '每分钟抓取三方游戏数据的记录',
             ],
             [
              'command'  => 'gameReportDay',
              'schedule' => '0 3 * * *',
              'argument' => null,
              'option'   => null,
              'status'   => 1,
              'remarks'  => '每日凌晨3点生成前一天的游戏日报表',
             ],
             [
              'command'  => 'statisticalCommission',
              'schedule' => '0 2 * * *',
              'argument' => null,
              'option'   => null,
              'status'   => 1,
              'remarks'  => '每日凌晨2点计算前一天的游戏洗码',
             ],
            ],
        );
    }
}
