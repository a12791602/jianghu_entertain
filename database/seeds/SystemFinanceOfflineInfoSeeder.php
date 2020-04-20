<?php

use App\Models\Finance\SystemFinanceOfflineInfo;
use Illuminate\Database\Seeder;

/**
 * Class SystemFinanceOfflineInfoSeeder
 */
class SystemFinanceOfflineInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemFinanceOfflineInfo::insert(
            [
             [
              'type_id'        => 1,
              'platform_id'    => 1,
              'bank_id'        => 1,
              'name'           => '中国人民银行',
              'remark'         => null,
              'qrcode'         => null,
              'account'        => '666666666666666666',
              'username'       => '亚历克斯',
              'min_amount'     => '1.0000',
              'max_amount'     => '20000.0000',
              'status'         => 1,
              'branch'         => '菲律宾支行',
              'author_id'      => 1,
              'last_editor_id' => 1,
              'fee'            => '2.0000',
              'created_at'     => '2020-01-09 19:07:24',
              'updated_at'     => '2020-01-09 19:07:24',
             ],
             [
              'type_id'        => 2,
              'platform_id'    => 1,
              'bank_id'        => 0,
              'name'           => '支付宝转账',
              'remark'         => null,
              'qrcode'         => null,
              'account'        => 'alex@163.com',
              'username'       => '亚历克斯',
              'min_amount'     => '100.0000',
              'max_amount'     => '2000.0000',
              'status'         => 1,
              'branch'         => ' ',
              'author_id'      => 1,
              'last_editor_id' => 1,
              'fee'            => '2.0000',
              'created_at'     => '2020-01-09 19:08:35',
              'updated_at'     => '2020-01-09 19:08:35',
             ],
            ],
        );
    }
}
