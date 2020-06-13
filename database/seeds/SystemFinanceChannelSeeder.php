<?php

use App\Models\Finance\SystemFinanceChannel;
use Illuminate\Database\Seeder;

/**
 * Class SystemFinanceChannelSeeder
 */
class SystemFinanceChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemFinanceChannel::insert(
            [
             [
              'id'             => 1,
              'type_id'        => 5,
              'vendor_id'      => 1,
              'name'           => '天道(支付宝扫码)',
              'sign'           => '903',
              'request_mode'   => 0,
              'banks_code'     => null,
              'status'         => 1,
              'desc'           => null,
              'author_id'      => 1,
              'last_editor_id' => 1,
              'created_at'     => '2020-01-09 18:34:25',
              'updated_at'     => '2020-01-09 18:35:23',
             ],
             [
              'id'             => 2,
              'type_id'        => 6,
              'vendor_id'      => 1,
              'name'           => '天道(微信扫码支付)',
              'sign'           => '902',
              'request_mode'   => 0,
              'banks_code'     => null,
              'status'         => 1,
              'desc'           => null,
              'author_id'      => 1,
              'last_editor_id' => 1,
              'created_at'     => '2020-06-13 17:18:01',
              'updated_at'     => '2020-06-13 17:21:17',
             ],
             [
              'id'             => 3,
              'type_id'        => 5,
              'vendor_id'      => 1,
              'name'           => '天道(支付宝WAP)',
              'sign'           => '904',
              'request_mode'   => 0,
              'banks_code'     => null,
              'status'         => 1,
              'desc'           => null,
              'author_id'      => 1,
              'last_editor_id' => 1,
              'created_at'     => '2020-06-13 17:20:58',
              'updated_at'     => '2020-06-13 17:20:58',
             ],
             [
              'id'             => 4,
              'type_id'        => 6,
              'vendor_id'      => 1,
              'name'           => '天道(微信H5)',
              'sign'           => '914',
              'request_mode'   => 0,
              'banks_code'     => null,
              'status'         => 1,
              'desc'           => null,
              'author_id'      => 1,
              'last_editor_id' => 1,
              'created_at'     => '2020-06-13 17:22:16',
              'updated_at'     => '2020-06-13 17:22:16',
             ],
             [
              'id'             => 5,
              'type_id'        => 7,
              'vendor_id'      => 1,
              'name'           => '天道(云闪付)',
              'sign'           => '916',
              'request_mode'   => 0,
              'banks_code'     => null,
              'status'         => 1,
              'desc'           => null,
              'author_id'      => 1,
              'last_editor_id' => 1,
              'created_at'     => '2020-06-13 17:24:39',
              'updated_at'     => '2020-06-13 17:24:39',
             ],
            ],
        );
    }
}
