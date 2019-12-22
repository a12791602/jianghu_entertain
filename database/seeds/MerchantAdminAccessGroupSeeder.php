<?php

use App\Models\Admin\MerchantAdminAccessGroup;
use Illuminate\Database\Seeder;

/**
 * Class MerchantAdminAccessGroupSeeder
 */
class MerchantAdminAccessGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        MerchantAdminAccessGroup::insert(
            [
                [
                    'group_name' => '超级管理组',
                    'status' => 1,
                    'platform_sign' => 'b',
                    'is_super' => 1,
                ],
            ],
        );
    }
}
