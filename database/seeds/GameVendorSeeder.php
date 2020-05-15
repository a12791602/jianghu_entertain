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
              'icon_id'        => 121,
              'type_id'        => 1,
              'sort'           => 1,
              'status'         => 1,
              'production'     => '{"url": {"login": "http://login.third-party.com", "top_up_url": "http://top.third-party.com", "draw_out_url": "http://draw.third-party.com", "kick_out_url": "http://kick.third-party.com", "order_query_url": "http://order.third-party.com", "account_query_url": "http://account.third-party.com", "game_order_query_url": "http://game-order.third-party.com", "user_active_query_url": "http://online.third-party.com", "agent_account_query_url": "http://agent_account.third-party.com", "user_total_status_query_url": "http://user_total.third-party.com"}, "app_id": null, "des_key": "6734706BE7C69976", "md5_key": "F4474AB670FF9DCF", "public_key": null, "merchant_id": "64421", "private_key": null, "merchant_secret": null, "third_party_url": "https://api.ky039.com:443/channelHandle"}',
              'staging'        => '{"url": {"login": "http://login.third-party.com", "top_up_url": "http://top.third-party.com", "draw_out_url": "http://draw.third-party.com", "kick_out_url": "http://kick.third-party.com", "order_query_url": "http://order.third-party.com", "account_query_url": "http://account.third-party.com", "game_order_query_url": "http://game-order.third-party.com", "user_active_query_url": "http://online.third-party.com", "agent_account_query_url": "http://agent_account.third-party.com", "user_total_status_query_url": "http://user_total.third-party.com"}, "app_id": null, "des_key": "6734706BE7C69976", "md5_key": "F4474AB670FF9DCF", "public_key": null, "merchant_id": "64421", "private_key": null, "merchant_secret": null, "third_party_url": "https://api.ky039.com:443/channelHandle"}',
              'author_id'      => 1,
              'last_editor_id' => 1,
              'needCreateAcc'  => 0,
              'created_at'     => '2020-04-10 22:40:41',
              'updated_at'     => '2020-05-13 16:32:15',
             ],
             [
              'id'             => 2,
              'name'           => 'VR视讯',
              'sign'           => 'VR',
              'icon_id'        => 390,
              'type_id'        => 5,
              'sort'           => 2,
              'status'         => 1,
              'production'     => '{"url": {"login": "https://fykjs.vrbetapi.com//no-url", "top_up_url": "https://fykjs.vrbetapi.com//no-url", "draw_out_url": "https://fykjs.vrbetapi.com//no-url", "kick_out_url": "https://fykjs.vrbetapi.com//Account/KickUser", "order_query_url": "https://fykjs.vrbetapi.com//no-url", "account_query_url": "https://fykjs.vrbetapi.com//no-url", "game_order_query_url": "https://fykjs.vrbetapi.com//MerchantQuery/GameBet", "user_active_query_url": "https://fykjs.vrbetapi.com//Account/LoginValidate", "agent_account_query_url": "https://fykjs.vrbetapi.com//no-url", "user_total_status_query_url": "https://fykjs.vrbetapi.com//no-url"}, "app_id": null, "des_key": null, "md5_key": null, "public_key": null, "merchant_id": "JHHY", "private_key": null, "merchant_secret": "L86808N04L4R6B844TF4448N2R6684XL", "third_party_url": "https://fykjs.vrbetapi.com/"}',
              'staging'        => '{"url": {"login": "http://fe.vrbetdemo.com/no-url", "top_up_url": "http://fe.vrbetdemo.com/no-url", "draw_out_url": "http://fe.vrbetdemo.com/no-url", "kick_out_url": "http://fe.vrbetdemo.com/Account/KickUser", "order_query_url": "http://fe.vrbetdemo.com/no-url", "account_query_url": "http://fe.vrbetdemo.com/no-url", "game_order_query_url": "http://fe.vrbetdemo.com/MerchantQuery/GameBet", "user_active_query_url": "http://fe.vrbetdemo.com/Account/LoginValidate", "agent_account_query_url": "http://fe.vrbetdemo.com/no-url", "user_total_status_query_url": "http://fe.vrbetdemo.com/no-url"}, "app_id": null, "des_key": null, "md5_key": null, "public_key": null, "merchant_id": "JHHY", "private_key": null, "merchant_secret": "L86808N04L4R6B844TF4448N2R6684XL", "third_party_url": "http://fe.vrbetdemo.com"}',
              'author_id'      => 1,
              'last_editor_id' => 1,
              'needCreateAcc'  => 1,
              'created_at'     => '2020-04-10 22:40:41',
              'updated_at'     => '2020-05-15 15:28:24',
             ],
             [
              'id'             => 3,
              'name'           => 'IM体育',
              'sign'           => 'IM',
              'icon_id'        => 211,
              'type_id'        => 2,
              'sort'           => 3,
              'status'         => 1,
              'production'     => '{"url": {"login": "http://imone.imaegisapi.com/Game/NewLaunchGame", "top_up_url": "http://imone.imaegisapi.com/no-url", "draw_out_url": "http://imone.imaegisapi.com/Transaction/PerformTransfer", "kick_out_url": "http://imone.imaegisapi.com/no-url", "order_query_url": "http://imone.imaegisapi.com/no-url", "account_query_url": "http://imone.imaegisapi.com/Player/GetBalance", "game_order_query_url": "http://imone.imaegisapi.com/no-url", "user_active_query_url": "http://imone.imaegisapi.com/no-url", "agent_account_query_url": "http://imone.imaegisapi.com/no-url", "user_total_status_query_url": "http://imone.imaegisapi.com/no-url"}, "app_id": null, "des_key": null, "md5_key": null, "public_key": null, "merchant_id": "24jhhyprod", "private_key": null, "merchant_secret": "LDhqQyDjR4wukKYG", "third_party_url": "http://imone.imaegisapi.com"}',
              'staging'        => '{"url": {"login": "http://operatorapi.staging.imaegisapi.com/Game/NewLaunchGame", "top_up_url": "http://operatorapi.staging.imaegisapi.com/no-url", "draw_out_url": "http://operatorapi.staging.imaegisapi.com/Transaction/PerformTransfer", "kick_out_url": "http://operatorapi.staging.imaegisapi.com/no-url", "order_query_url": "http://operatorapi.staging.imaegisapi.com/no-url", "account_query_url": "http://operatorapi.staging.imaegisapi.com/Player/GetBalance", "game_order_query_url": "http://operatorapi.staging.imaegisapi.com/no-url", "user_active_query_url": "http://operatorapi.staging.imaegisapi.com/no-url", "agent_account_query_url": "http://operatorapi.staging.imaegisapi.com/no-url", "user_total_status_query_url": "http://operatorapi.staging.imaegisapi.com/no-url"}, "app_id": null, "des_key": null, "md5_key": null, "public_key": null, "merchant_id": "24jhhyprod", "private_key": null, "merchant_secret": "OYjMg5Bgwq5XhwoIY6aSW37LzjNQuXvK", "third_party_url": "http://operatorapi.staging.imaegisapi.com"}',
              'author_id'      => 1,
              'last_editor_id' => 1,
              'needCreateAcc'  => 1,
              'created_at'     => '2020-04-30 22:40:41',
              'updated_at'     => '2020-05-13 17:46:42',
             ],
            ],
        );
    }
}
