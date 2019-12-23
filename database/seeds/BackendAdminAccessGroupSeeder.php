<?php

use App\Models\Admin\BackendAdminAccessGroup;
use Illuminate\Database\Seeder;

/**
 * Class BackendAdminAccessGroupSeeder
 */
class BackendAdminAccessGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        BackendAdminAccessGroup::insert(
            [
                [
                    'id' => 1,
                    'group_name' => '超级管理组',
                    'status' => 1,
                    'recharge_status' => 0,
                ],
                [
                    'id' => 3,
                    'group_name' => '彩票组',
                    'status' => 1,
                    'recharge_status' => 0,
                ],
                [
                    'id' => 13,
                    'group_name' => '客服组',
                    'status' => 1,
                    'recharge_status' => 0,
                ],
                [
                    'id' => 17,
                    'group_name' => '测试',
                    'status' => 1,
                    'recharge_status' => 0,
                ],
                [
                    'id' => 18,
                    'group_name' => 'a4',
                    'status' => 1,
                    'recharge_status' => 0,
                ],
                [
                    'id' => 21,
                    'group_name' => '彩票组',
                    'status' => 1,
                    'recharge_status' => 0,
                ],
                [
                    'id' => 25,
                    'group_name' => 'a5',
                    'status' => 1,
                    'recharge_status' => 0,
                ],
                [
                    'id' => 26,
                    'group_name' => 'a8',
                    'status' => 1,
                    'recharge_status' => 0,
                ],
            ],
        );
    }
}
