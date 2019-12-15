<?php

use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use Illuminate\Database\Seeder;

/**
 * Class SystemRoutesMerchantSeeder
 */
class SystemRoutesMerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemRoutesMerchant::insert(
            [
                [
                    'route_name' => 'merchant-api.menu.current-admin-menu',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-user.create',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-user.get-all-admins',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-user.update-admin-group',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-user.delete-admin',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-user.search-admin',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-group.create',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-group.detail',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-group.edit',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-group.delete',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.merchant-admin-group.specific-group-users',
                    'method' => '',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.login',
                    'method' => 'login',
                    'menu_group_id' => 2,
                    'is_open' => 1,
                ],
                [
                    'route_name' => 'merchant-api.logout',
                    'method' => 'logout',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.game-type.index',
                    'method' => 'index',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.game-type.status',
                    'method' => 'status',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.game-vendor.index',
                    'method' => 'index',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.game-vendor.status',
                    'method' => 'status',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.game-vendor.sort',
                    'method' => 'sort',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'merchant-api.frontend-user.index',
                    'method' => 'index',
                    'menu_group_id' => 2,
                    'is_open' => 0,
                ],
            ],
        );
    }
}
