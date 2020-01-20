<?php

use App\Models\DeveloperUsage\Frontend\SystemRoutesH5;
use Illuminate\Database\Seeder;

/**
 * Class SystemRoutesH5Seeder
 */
class SystemRoutesH5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemRoutesH5::insert(
            [
             [
              'route_name' => 'h5-api.login',
              'method'     => 'login',
              'is_open'    => 1,
             ],
             [
              'route_name' => 'h5-api.logout',
              'method'     => 'logout',
              'is_open'    => 0,
             ],
             [
              'route_name' => 'h5-api.user.refresh-token',
              'method'     => 'refreshToken',
              'is_open'    => 0,
             ],
             [
              'route_name' => 'h5-api.games-lobby.games-categories',
              'method'     => 'category',
              'is_open'    => 1,
             ],
             [
              'route_name' => 'h5-api.games-lobby.slides',
              'method'     => 'slides',
              'is_open'    => 1,
             ],
             [
              'route_name' => 'h5-api.user.information',
              'method'     => 'information',
              'is_open'    => 0,
             ],
             [
              'route_name' => 'h5-api.user.game-list',
              'method'     => 'gameList',
              'is_open'    => 1,
             ],
             [
              'route_name' => 'h5-api.register',
              'method'     => 'store',
              'is_open'    => 1,
             ],
             [
              'route_name' => 'h5-api.register.verification-code',
              'method'     => 'code',
              'is_open'    => 1,
             ],
             [
              'route_name' => 'h5-api.user.reset-password',
              'method'     => 'password',
              'is_open'    => 1,
             ],
             [
              'route_name' => 'h5-api.reset-password.verification-code',
              'method'     => 'passwordCode',
              'is_open'    => 1,
             ],
             [
              'route_name' => 'h5-api.user.security-code',
              'method'     => 'security',
              'is_open'    => 0,
             ],
             [
              'route_name' => 'h5-api.user.security-verification-code',
              'method'     => 'securityCode',
              'is_open'    => 0,
             ],
             [
              'route_name' => 'h5-api.recharge.recharge',
              'method'     => 'recharge',
              'is_open'    => 0,
             ],
             [
              'route_name' => 'h5-api.user.grades',
              'method'     => 'grades',
              'is_open'    => 0,
             ],
             [
              'route_name' => 'h5-api.games-lobby.in-game',
              'method'     => 'inGame',
              'is_open'    => 0,
             ],
            ],
        );
    }
}
