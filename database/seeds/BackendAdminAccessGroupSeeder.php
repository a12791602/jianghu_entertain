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
              'id'              => 1,
              'group_name'      => '超级管理组',
              'status'          => 1,
              'recharge_status' => 0,
             ],
            ],
        );
    }
}
