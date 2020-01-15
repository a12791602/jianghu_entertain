<?php

use App\Models\Game\Game;
use Illuminate\Database\Seeder;

/**
 * Class GameSeeder
 */
class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Game::insert(
            [
             [
              'type_id'                    => 1,
              'vendor_id'                  => 1,
              'name'                       => '开心下象棋',
              'sign'                       => 'kxxxq',
              'request_mode'               => 1,
              'conver_url'                 => 'http://aaa.com',
              'test_conver_url'            => 'http://aaa.com',
              'check_balance_url'          => 'http://aaa.com',
              'test_check_balance_url'     => 'http://aaa.com',
              'check_order_url'            => 'http://aaa.com',
              'test_check_order_url'       => 'http://aaa.com',
              'in_game_url'                => 'http://aaa.com',
              'test_in_game_url'           => 'http://aaa.com',
              'get_station_order_url'      => 'http://aaa.com',
              'test_get_station_order_url' => 'http://aaa.com',
              'status'                     => 1,
              'app_id'                     => 'afafafadsfdadfsa',
              'authorization_code'         => 'fdadffdasfdasfdsa',
              'merchant_code'              => 'fdasfdfdafdsafad',
              'merchant_secret'            => 'vadfgdasfdsafadsfdafdas',
              'public_key'                 => 'ffadsfdafadfafdafadfdas',
              'private_key'                => 'fasdfadfdsafdasfadsfdasf',

             ],
             [
              'type_id'                    => 1,
              'vendor_id'                  => 1,
              'name'                       => '斗地主',
              'sign'                       => 'ddz',
              'request_mode'               => 1,
              'conver_url'                 => 'http://aaa.com',
              'test_conver_url'            => 'http://aaa.com',
              'check_balance_url'          => 'http://aaa.com',
              'test_check_balance_url'     => 'http://aaa.com',
              'check_order_url'            => 'http://aaa.com',
              'test_check_order_url'       => 'http://aaa.com',
              'in_game_url'                => 'http://aaa.com',
              'test_in_game_url'           => 'http://aaa.com',
              'get_station_order_url'      => 'http://aaa.com',
              'test_get_station_order_url' => 'http://aaa.com',
              'status'                     => 1,
              'app_id'                     => 'afafafadsfdadfsa',
              'authorization_code'         => 'fdadffdasfdasfdsa',
              'merchant_code'              => 'fdasfdfdafdsafad',
              'merchant_secret'            => 'vadfgdasfdsafadsfdafdas',
              'public_key'                 => 'ffadsfdafadfafdafadfdas',
              'private_key'                => 'fasdfadfdsafdasfadsfdasf',
             ],
             [
              'type_id'                    => 2,
              'vendor_id'                  => 1,
              'name'                       => '北京PK10',
              'sign'                       => 'bjpk',
              'request_mode'               => 1,
              'conver_url'                 => 'http://aaa.com',
              'test_conver_url'            => 'http://aaa.com',
              'check_balance_url'          => 'http://aaa.com',
              'test_check_balance_url'     => 'http://aaa.com',
              'check_order_url'            => 'http://aaa.com',
              'test_check_order_url'       => 'http://aaa.com',
              'in_game_url'                => 'http://aaa.com',
              'test_in_game_url'           => 'http://aaa.com',
              'get_station_order_url'      => 'http://aaa.com',
              'test_get_station_order_url' => 'http://aaa.com',
              'status'                     => 1,
              'app_id'                     => 'afafafadsfdadfsa',
              'authorization_code'         => 'fdadffdasfdasfdsa',
              'merchant_code'              => 'fdasfdfdafdsafad',
              'merchant_secret'            => 'vadfgdasfdsafadsfdafdas',
              'public_key'                 => 'ffadsfdafadfafdafadfdas',
              'private_key'                => 'fasdfadfdsafdasfadsfdasf',
             ],
            ],
        );
    }
}
