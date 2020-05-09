<?php

use App\Models\Game\GameVendor;
use Illuminate\Database\Seeder;

/**
 * Class GameVendorSeeder
 */
class GameVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GameVendor::insert(
            [
             [
              'id'             => 1,
              'name'           => '开源棋牌',
              'sign'           => 'KY',
              'type_id'        => 1,
              'sort'           => 1,
              'status'         => 1,
              'production'     => '{"url": {"login": "http://www.third-party.com/login", "top_up_url": "http://www.third-party.com/top", "draw_out_url": "http://www.third-party.com/draw", "kick_out_url": "http://www.third-party.com/kick", "order_query_url": "http://www.third-party.com/order", "account_query_url": "http://www.third-party.com/account", "game_order_query_url": "http://www.third-party.com/game-order", "user_active_query_url": "http://www.third-party.com/online", "agent_account_query_url": "http://www.third-party.com/agent_account", "user_total_status_query_url": "http://www.third-party.com/user_total"}, "app_id": "83745293409", "des_key": "6734706BE7C69976", "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "merchant_id": "7464303402", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG", "third_party_url": "http://www.third-party.com/order", "is_official_station": "1"}',
              'staging'        => '{"url": {"login": "http://www.third-party.com/login", "top_up_url": "http://www.third-party.com/top", "draw_out_url": "http://www.third-party.com/draw", "kick_out_url": "http://www.third-party.com/kick", "order_query_url": "http://www.third-party.com/order", "account_query_url": "http://www.third-party.com/account", "game_order_query_url": "http://www.third-party.com/game-order", "user_active_query_url": "http://www.third-party.com/online", "agent_account_query_url": "http://www.third-party.com/agent_account", "user_total_status_query_url": "http://www.third-party.com/user_total"}, "app_id": "83745293409", "des_key": "6734706BE7C69976", "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "merchant_id": "7464303402", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG", "third_party_url": "http://www.third-party.com/order", "is_official_station": "1"}',
              'author_id'      => 1,
              'last_editor_id' => 1,
              'needCreateAcc'  => 0,
              'created_at'     => '2020-04-10 22:40:41',
              'updated_at'     => '2020-05-10 01:23:10',
             ],
             [
              'id'             => 2,
              'name'           => 'VR视讯',
              'sign'           => 'VR',
              'type_id'        => 5,
              'sort'           => 2,
              'status'         => 1,
              'production'     => '{"url": {"login": "http://www.third-party.com/login", "top_up_url": "http://www.third-party.com/top", "draw_out_url": "http://www.third-party.com/draw", "kick_out_url": "http://www.third-party.com/kick", "order_query_url": "http://www.third-party.com/order", "account_query_url": "http://www.third-party.com/account", "game_order_query_url": "http://www.third-party.com/game-order", "user_active_query_url": "http://www.third-party.com/online", "agent_account_query_url": "http://www.third-party.com/agent_account", "user_total_status_query_url": "http://www.third-party.com/user_total"}, "app_id": "83745293409", "des_key": "6734706BE7C69976", "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "merchant_id": "7464303402", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG", "third_party_url": "http://www.third-party.com/order", "is_official_station": "1"}',
              'staging'        => '{"url": {"login": "http://www.third-party.com/login", "top_up_url": "http://www.third-party.com/top", "draw_out_url": "http://www.third-party.com/draw", "kick_out_url": "http://www.third-party.com/kick", "order_query_url": "http://www.third-party.com/order", "account_query_url": "http://www.third-party.com/account", "game_order_query_url": "http://www.third-party.com/game-order", "user_active_query_url": "http://www.third-party.com/online", "agent_account_query_url": "http://www.third-party.com/agent_account", "user_total_status_query_url": "http://www.third-party.com/user_total"}, "app_id": "83745293409", "des_key": "6734706BE7C69976", "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "merchant_id": "7464303402", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG", "third_party_url": "http://www.third-party.com/order", "is_official_station": "1"}',
              'author_id'      => 1,
              'last_editor_id' => 2,
              'needCreateAcc'  => 1,
              'created_at'     => '2020-04-10 22:40:41',
              'updated_at'     => '2020-05-10 01:24:55',
             ],
             [
              'id'             => 3,
              'name'           => 'IM体育',
              'sign'           => 'IM',
              'type_id'        => 2,
              'sort'           => 3,
              'status'         => 1,
              'production'     => '{"url": {"login": "http://www.third-party.com/login", "top_up_url": "http://www.third-party.com/top", "draw_out_url": "http://www.third-party.com/draw", "kick_out_url": "http://www.third-party.com/kick", "order_query_url": "http://www.third-party.com/order", "account_query_url": "http://www.third-party.com/account", "game_order_query_url": "http://www.third-party.com/game-order", "user_active_query_url": "http://www.third-party.com/online", "agent_account_query_url": "http://www.third-party.com/agent_account", "user_total_status_query_url": "http://www.third-party.com/user_total"}, "app_id": "83745293409", "des_key": "6734706BE7C69976", "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "merchant_id": "7464303402", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG", "third_party_url": "http://www.third-party.com/order", "is_official_station": "1"}',
              'staging'        => '{"url": {"login": "http://www.third-party.com/login", "top_up_url": "http://www.third-party.com/top", "draw_out_url": "http://www.third-party.com/draw", "kick_out_url": "http://www.third-party.com/kick", "order_query_url": "http://www.third-party.com/order", "account_query_url": "http://www.third-party.com/account", "game_order_query_url": "http://www.third-party.com/game-order", "user_active_query_url": "http://www.third-party.com/online", "agent_account_query_url": "http://www.third-party.com/agent_account", "user_total_status_query_url": "http://www.third-party.com/user_total"}, "app_id": "83745293409", "des_key": "6734706BE7C69976", "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "merchant_id": "7464303402", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG", "third_party_url": "http://www.third-party.com/order", "is_official_station": "1"}',
              'author_id'      => 1,
              'last_editor_id' => 2,
              'needCreateAcc'  => 1,
              'created_at'     => '2020-04-30 22:40:41',
              'updated_at'     => '2020-05-10 01:25:35',
             ],
            ],
        );
    }
}
