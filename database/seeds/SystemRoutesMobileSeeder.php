<?php

use App\Models\DeveloperUsage\Frontend\SystemRoutesMobile;
use Illuminate\Database\Seeder;

/**
 * Class SystemRoutesMobileSeeder
 */
class SystemRoutesMobileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemRoutesMobile::insert(
            [
                [
                    'route_name' => 'app-api.login',
                    'method' => 'login',
                    'is_open' => 1,
                ],
                [
                    'route_name' => 'app-api.logout',
                    'method' => 'logout',
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'app-api.user.refresh-token',
                    'method' => 'refreshToken',
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'app-api.games-lobby.rich-list',
                    'method' => 'richList',
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'app-api.games-lobby.games-categories',
                    'method' => 'category',
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'app-api.user.information',
                    'method' => 'information',
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'app-api.user.game-list',
                    'method' => 'gameList',
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'app-api.register',
                    'method' => 'store',
                    'is_open' => 1,
                ],
                [
                    'route_name' => 'app-api.register/verification-code',
                    'method' => 'code',
                    'is_open' => 1,
                ],
                [
                    'route_name' => 'app-api.user.home-information',
                    'method' => 'homeInformation',
                    'is_open' => 0,
                ],
                [
                    'route_name' => 'app-api.user.reset-password',
                    'method' => 'store',
                    'is_open' => 1,
                ],
                [
                    'route_name' => 'app-api.reset-password.verification-code',
                    'method' => 'code',
                    'is_open' => 1,
                ],
            ],
        );
    }
}
