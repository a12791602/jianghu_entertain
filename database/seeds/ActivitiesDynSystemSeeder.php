<?php

use App\Models\Activity\ActivitiesDynSystem;
use Illuminate\Database\Seeder;

/**
 * 动态活动数据表的种子文件
 * Class SystemDynActivitySeeder
 */
class ActivitiesDynSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ActivitiesDynSystem::insert(
            [
             [
              'name'           => '幸运转盘',
              'sign'           => 'TURNTABLE',
              'last_editor_id' => 0,
              'status'         => 1,
             ],
             [
              'name'           => '抢红包',
              'sign'           => 'RED',
              'last_editor_id' => 0,
              'status'         => 1,
             ],
            ],
        );
    }
}
