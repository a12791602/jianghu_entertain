<?php

use App\Models\Admin\MerchantAdminAccessGroupsHasBackendSystemMenu;
use Illuminate\Database\Seeder;

/**
 * Class MerchantAdminAccessGroupsHasBackendSystemMenuSeeder
 */
class MerchantAdminAccessGroupsHasBackendSystemMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        MerchantAdminAccessGroupsHasBackendSystemMenu::insert(
            [
                [
                    'id' => 1,
                    'group_id' => 1,
                    'menu_id' => 1,
                ],
                [
                    'id' => 2,
                    'group_id' => 1,
                    'menu_id' => 2,
                ],
                [
                    'id' => 3,
                    'group_id' => 1,
                    'menu_id' => 3,
                ],
                [
                    'id' => 4,
                    'group_id' => 1,
                    'menu_id' => 4,
                ],
                [
                    'id' => 5,
                    'group_id' => 1,
                    'menu_id' => 5,
                ],
            ],
        );
    }
}
