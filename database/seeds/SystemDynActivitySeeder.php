<?php

use App\Models\Activity\SystemDynActivity;
use Illuminate\Database\Seeder;

/**
 * 动态活动数据表的种子文件
 * Class SystemDynActivitySeeder
 */
class SystemDynActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemDynActivity::insert(
            [
                [
                    'name' => '幸运转盘',
                    'sign' => 'TURNTABLE',
                    'last_editor_id' => 0,
                    'status' => 1,
                ],
                [
                    'name' => '抢红包',
                    'sign' => 'RED',
                    'last_editor_id' => 0,
                    'status' => 1,
                ],
            ],
        );
    }
}
