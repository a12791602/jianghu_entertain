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
              'name'       => '银行卡转账',
              'sign'       => 'bank_transfer',
              'is_online'  => 0,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:20:06',
              'updated_at' => '2020-01-09 18:20:06',
             ],
             [
              'name'       => '支付宝转账',
              'sign'       => 'alipay_transfer',
              'is_online'  => 0,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:20:40',
              'updated_at' => '2020-01-09 18:20:40',
             ],
             [
              'name'       => '微信转账',
              'sign'       => 'wechat_transfer',
              'is_online'  => 0,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:20:54',
              'updated_at' => '2020-01-09 18:20:54',
             ],
             [
              'name'       => '云闪付转账',
              'sign'       => 'unionPay_transfer',
              'is_online'  => 0,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:21:49',
              'updated_at' => '2020-01-09 18:21:49',
             ],
             [
              'name'       => '支付宝支付',
              'sign'       => 'alipay',
              'is_online'  => 1,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:22:11',
              'updated_at' => '2020-01-09 18:22:11',
             ],
             [
              'name'       => '微信支付',
              'sign'       => 'wechat',
              'is_online'  => 1,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:22:26',
              'updated_at' => '2020-01-09 18:22:26',
             ],
             [
              'name'       => '银联支付',
              'sign'       => 'unionPay',
              'is_online'  => 1,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:22:59',
              'updated_at' => '2020-01-09 18:22:59',
             ],
             [
              'name'       => '在线网银支付',
              'sign'       => 'online_bank',
              'is_online'  => 1,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:23:57',
              'updated_at' => '2020-01-09 18:23:57',
             ],
             [
              'name'       => '京东钱包',
              'sign'       => 'jd',
              'is_online'  => 1,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:24:26',
              'updated_at' => '2020-01-09 18:24:26',
             ],
             [
              'name'       => '百度钱包',
              'sign'       => 'baidu',
              'is_online'  => 1,
              'direction'  => 1,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:24:42',
              'updated_at' => '2020-01-09 18:24:42',
             ],
             [
              'name'       => '在线出款',
              'sign'       => 'withdraw',
              'is_online'  => 1,
              'direction'  => 0,
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-01-09 18:28:05',
              'updated_at' => '2020-01-09 18:28:05',
             ],
            ],
        );
    }
}
