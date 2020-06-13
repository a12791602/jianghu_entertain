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
              'type_id'        => 5,
              'vendor_id'      => 1,
              'name'           => '天道(支付宝扫码)',
              'sign'           => '903',
              'request_mode'   => 0,
              'status'         => 1,
              'author_id'      => 2,
              'last_editor_id' => 2,
              'created_at'     => '2020-01-09 18:34:25',
              'updated_at'     => '2020-01-09 18:35:23',
             ],
            ],
        );
    }
}
