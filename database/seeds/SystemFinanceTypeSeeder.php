<?php

use App\Models\Finance\SystemFinanceType;
use Illuminate\Database\Seeder;

/**
 * Class SystemFinanceTypeSeeder
 */
class SystemFinanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemFinanceType::insert(
            [
             [
              'id'             => 1,
              'name'           => '银行卡转账',
              'sign'           => 'bank_transfer',
              'ico'            => null,
              'is_online'      => 0,
              'direction'      => 1,
              'status'         => 1,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:20:06',
              'updated_at'     => '2020-01-09 18:20:06',
             ],
             [
              'id'             => 2,
              'name'           => '支付宝转账',
              'sign'           => 'alipay_transfer',
              'ico'            => null,
              'is_online'      => 0,
              'direction'      => 1,
              'status'         => 1,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:20:40',
              'updated_at'     => '2020-01-09 18:20:40',
             ],
             [
              'id'             => 3,
              'name'           => '微信转账',
              'sign'           => 'wechat_transfer',
              'ico'            => null,
              'is_online'      => 0,
              'direction'      => 1,
              'status'         => 0,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:20:54',
              'updated_at'     => '2020-01-09 18:20:54',
             ],
             [
              'id'             => 4,
              'name'           => '云闪付转账',
              'sign'           => 'unionPay_transfer',
              'ico'            => null,
              'is_online'      => 0,
              'direction'      => 1,
              'status'         => 0,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:21:49',
              'updated_at'     => '2020-01-09 18:21:49',
             ],
             [
              'id'             => 5,
              'name'           => '支付宝支付',
              'sign'           => 'alipay',
              'ico'            => null,
              'is_online'      => 1,
              'direction'      => 1,
              'status'         => 1,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:22:11',
              'updated_at'     => '2020-01-09 18:22:11',
             ],
             [
              'id'             => 6,
              'name'           => '微信支付',
              'sign'           => 'wechat',
              'ico'            => null,
              'is_online'      => 1,
              'direction'      => 1,
              'status'         => 1,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:22:26',
              'updated_at'     => '2020-01-09 18:22:26',
             ],
             [
              'id'             => 7,
              'name'           => '银联支付',
              'sign'           => 'unionPay',
              'ico'            => null,
              'is_online'      => 1,
              'direction'      => 1,
              'status'         => 1,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:22:59',
              'updated_at'     => '2020-01-09 18:22:59',
             ],
             [
              'id'             => 8,
              'name'           => '在线网银支付',
              'sign'           => 'online_bank',
              'ico'            => null,
              'is_online'      => 1,
              'direction'      => 1,
              'status'         => 0,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:23:57',
              'updated_at'     => '2020-01-09 18:23:57',
             ],
             [
              'id'             => 9,
              'name'           => '京东钱包',
              'sign'           => 'jd',
              'ico'            => null,
              'is_online'      => 1,
              'direction'      => 1,
              'status'         => 0,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:24:26',
              'updated_at'     => '2020-01-09 18:24:26',
             ],
             [
              'id'             => 10,
              'name'           => '百度钱包',
              'sign'           => 'baidu',
              'ico'            => null,
              'is_online'      => 1,
              'direction'      => 1,
              'status'         => 0,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:24:42',
              'updated_at'     => '2020-01-09 18:24:42',
             ],
             [
              'id'             => 11,
              'name'           => '在线出款',
              'sign'           => 'withdraw',
              'ico'            => null,
              'is_online'      => 1,
              'direction'      => 0,
              'status'         => 0,
              'author_id'      => 2,
              'last_editor_id' => 0,
              'created_at'     => '2020-01-09 18:28:05',
              'updated_at'     => '2020-01-09 18:28:05',
             ],
            ],
        );
    }
}
