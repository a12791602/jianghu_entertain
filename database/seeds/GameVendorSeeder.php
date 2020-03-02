<?php

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
              'sign'            => 'ky',
              'type_id'         => 1,
              'whitelist_ips'   => '127.0.0.1',
              'sort'            => 1,
              'status'          => 1,
              'url'             => null,
              'test_url'        => null,
              'app_id'          => null,
              'merchant_id'     => '64421',
              'merchant_secret' => null,
              'public_key'      => null,
              'des_key'         => '6734706BE7C69976',
              'md5_key'         => 'F4474AB670FF9DCF',
             ],
            ],
        );
    }
}
