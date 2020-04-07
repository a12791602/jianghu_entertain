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
              'name'            => '开源棋牌',
              'sign'            => 'KY',
              'type_id'         => 1,
              'sort'            => 1,
              'status'          => 1,
              'urls'            => '{"login":"login.third-party.com","account_query_url":"account.third-party.com","top_up_url":"top.third-party.com","draw_out_url":"draw.third-party.com","order_query_url":"order.third-party.com","user_active_query_url":"online.third-party.com","game_order_query_url":"game-order.third-party.com","user_total_status_query_url":"user_total.third-party.com","kick_out_url":"kick.third-party.com","agent_account_query_url":"agent_account.third-party.com"}',
              'test_urls'       => '{"login":"test.login.third-party.com"}',
              'app_id'          => '83745293409',
              'merchant_id'     => '64421',
              'merchant_secret' => 'LDhqQyDjR4wukKYG',
              'public_key'      => 'rmtTTgEF1GQNSB3LyqNVtQ9BDySfROIX',
              'private_key'     => 'U8UWQLaew9I6WpCpkZyYdgArEoXOBVFq',
              'des_key'         => '6734706BE7C69976',
              'md5_key'         => 'F4474AB670FF9DCF',
              'needCreateAcc'   => 0,
             ],
             [
              'name'            => 'VR视讯',
              'sign'            => 'VR',
              'type_id'         => 5,
              'sort'            => 2,
              'status'          => 1,
              'urls'            => null,
              'test_urls'       => null,
              'app_id'          => null,
              'merchant_id'     => 'JHHY',
              'merchant_secret' => 'L86808N04L4R6B844TF4448N2R6684XL',
              'public_key'      => null,
              'private_key'     => null,
              'des_key'         => null,
              'md5_key'         => null,
              'needCreateAcc'   => 1,
             ],
            ],
        );
    }
}
