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
              'type_id'        => 4,
              'sort'           => 1,
              'status'         => 1,
              'production'     => '{"url": {"login": "http://login.third-party.com", "top_up_url": "http://top.third-party.com", "draw_out_url": "http://draw.third-party.com", "kick_out_url": "http://kick.third-party.com", "order_query_url": "http://order.third-party.com", "account_query_url": "http://account.third-party.com", "game_order_query_url": "http://game-order.third-party.com", "user_active_query_url": "http://online.third-party.com", "agent_account_query_url": "http://agent_account.third-party.com", "user_total_status_query_url": "http://user_total.third-party.com"}, "app_id": "83745293409", "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "merchant_id": "7464303402", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG"}',
              'staging'        => '{"url": {"login": "http://login.third-party.com", "top_up_url": "http://top.third-party.com", "draw_out_url": "http://draw.third-party.com", "kick_out_url": "http://kick.third-party.com", "order_query_url": "http://order.third-party.com", "account_query_url": "http://account.third-party.com", "game_order_query_url": "http://game-order.third-party.com", "user_active_query_url": "http://online.third-party.com", "agent_account_query_url": "http://agent_account.third-party.com", "user_total_status_query_url": "http://user_total.third-party.com"}, "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG"}',
              'author_id'      => 1,
              'last_editor_id' => 2,
              'needCreateAcc'  => 0,
              'created_at'     => '2020-04-10 22:40:41',
              'updated_at'     => '2020-05-04 21:23:46',
             ],
             [
              'id'             => 2,
              'name'           => 'VR视讯',
              'sign'           => 'VR',
              'type_id'        => 5,
              'sort'           => 2,
              'status'         => 1,
              'production'     => '{"url": {"login": "http://login.third-party.com", "top_up_url": "http://top.third-party.com", "draw_out_url": "http://draw.third-party.com", "kick_out_url": "http://kick.third-party.com", "order_query_url": "http://order.third-party.com", "account_query_url": "http://account.third-party.com", "game_order_query_url": "http://game-order.third-party.com", "user_active_query_url": "http://online.third-party.com", "agent_account_query_url": "http://agent_account.third-party.com", "user_total_status_query_url": "http://user_total.third-party.com"}, "app_id": "83745293409", "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "merchant_id": "7464303402", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG"}',
              'staging'        => '{"url": {"login": "http://login.third-party.com", "top_up_url": "http://top.third-party.com", "draw_out_url": "http://draw.third-party.com", "kick_out_url": "http://kick.third-party.com", "order_query_url": "http://order.third-party.com", "account_query_url": "http://account.third-party.com", "game_order_query_url": "http://game-order.third-party.com", "user_active_query_url": "http://online.third-party.com", "agent_account_query_url": "http://agent_account.third-party.com", "user_total_status_query_url": "http://user_total.third-party.com"}, "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG"}',
              'author_id'      => 1,
              'last_editor_id' => 2,
              'needCreateAcc'  => 1,
              'created_at'     => '2020-04-10 22:40:41',
              'updated_at'     => '2020-05-04 21:25:31',
             ],
             [
              'id'             => 3,
              'name'           => 'IM体育',
              'sign'           => 'IM',
              'type_id'        => 2,
              'sort'           => 3,
              'status'         => 1,
              'production'     => '{"url": {"login": "http://login.third-party.com", "top_up_url": "http://top.third-party.com", "draw_out_url": "http://draw.third-party.com", "kick_out_url": "http://kick.third-party.com", "order_query_url": "http://order.third-party.com", "account_query_url": "http://account.third-party.com", "game_order_query_url": "http://game-order.third-party.com", "user_active_query_url": "http://online.third-party.com", "agent_account_query_url": "http://agent_account.third-party.com", "user_total_status_query_url": "http://user_total.third-party.com"}, "app_id": "83745293409", "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "merchant_id": "7464303402", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG"}',
              'staging'        => '{"url": {"login": "http://login.third-party.com", "top_up_url": "http://top.third-party.com", "draw_out_url": "http://draw.third-party.com", "kick_out_url": "http://kick.third-party.com", "order_query_url": "http://order.third-party.com", "account_query_url": "http://account.third-party.com", "game_order_query_url": "http://game-order.third-party.com", "user_active_query_url": "http://online.third-party.com", "agent_account_query_url": "http://agent_account.third-party.com", "user_total_status_query_url": "http://user_total.third-party.com"}, "md5_key": "F4474AB670FF9DCF", "public_key": "rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX", "private_key": "U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq", "merchant_secret": "LDhqQyDjR4wukKYG"}',
              'author_id'      => 1,
              'last_editor_id' => 2,
              'needCreateAcc'  => 1,
              'created_at'     => '2020-04-30 22:40:41',
              'updated_at'     => '2020-05-04 21:25:58',
             ],
            ],
        );
    }
}
