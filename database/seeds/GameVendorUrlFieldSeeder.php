<?php

use App\Models\Game\GameVendorUrlField;
use Illuminate\Database\Seeder;

/**
 * Class GameVendorUrlFieldSeeder
 */
class GameVendorUrlFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GameVendorUrlField::insert(
            [
             [
              'id'          => 1,
              'url_name'    => 'login_url',
              'url_comment' => '登录接口',
             ],
             [
              'id'          => 2,
              'url_name'    => 'account_query_url',
              'url_comment' => '查询余额接口',
             ],
             [
              'id'          => 3,
              'url_name'    => 'top_up_url',
              'url_comment' => '上分接口',
             ],
             [
              'id'          => 4,
              'url_name'    => 'draw_out_url',
              'url_comment' => '下分接口',
             ],
             [
              'id'          => 5,
              'url_name'    => 'order_query_url',
              'url_comment' => '查询订单接口',
             ],
             [
              'id'          => 6,
              'url_name'    => 'user_active_query_url',
              'url_comment' => '查询玩家在线状态',
             ],
             [
              'id'          => 7,
              'url_name'    => 'game_order_query_url',
              'url_comment' => '查询游戏注单',
             ],
             [
              'id'          => 8,
              'url_name'    => 'user_total_status_query_url',
              'url_comment' => '查询玩家总分【玩家账号，总余额，可下分余额，在线状态，在玩游戏中状态，等等。。】',
             ],
             [
              'id'          => 9,
              'url_name'    => 'kick_out_url',
              'url_comment' => '踢玩家接口',
             ],
             [
              'id'          => 10,
              'url_name'    => 'agent_account_query_url',
              'url_comment' => '查询代理余额接口',
             ],
            ],
        );
    }
}
