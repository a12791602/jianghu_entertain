<?php

use App\Models\Finance\SystemFinanceOnlineInfo;
use Illuminate\Database\Seeder;

/**
 * Class SystemFinanceOnlineInfoSeeder
 */
class SystemFinanceOnlineInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemFinanceOnlineInfo::insert(
            [
             [
              'frontend_name'   => '支付宝扫码1',
              'backend_remark'  => '第三方：天道支付 通道：支付宝扫码',
              'platform_sign'   => 'JHHY',
              'channel_id'      => 1,
              'min_amount'      => '200.00',
              'max_amount'      => '10000.00',
              'request_url'     => 'http://101.133.132.100:8088/Pay_Index_index.html',
              'merchant_code'   => '11296',
              'merchant_secret' => 'zfpODDwL5gS34PwTPkwu9wABdq0Krkfi',
              'desc'            => '充值完成后请耐心等待3分钟!',
              'encrypt_mode'    => 1,
              'status'          => 1,
              'author_id'       => 1,
              'last_editor_id'  => 1,
              'created_at'      => '2020-01-09 18:52:06',
              'updated_at'      => '2020-01-09 18:52:06',
             ],
            ],
        );
    }
}
