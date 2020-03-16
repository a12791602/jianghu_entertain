<?php

use App\Models\User\UsersWithdrawOrder;
use Illuminate\Database\Seeder;

/**
 * Class UsersWithdrawOrderSeeder
 */
class UsersWithdrawOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UsersWithdrawOrder::insert(
            [
             [
              'platform_sign'  => 'jhhy',
              'order_no'       => '20200314175458214961',
              'mobile'         => '18844446666',
              'user_id'        => 2,
              'amount'         => '100.0000',
              'before_balance' => '3000000.0000',
              'account_type'   => 1,
              'is_audit'       => 0,
              'status'         => 0,
              'month_total'    => '3000000.0000',
              'num_withdrawal' => 0,
              'num_top_up'     => 0,
              'account_snap'   => '{"owner_name":"\u4e9a\u7d22","card_number":"6228480402564890018","branch":"\u82cf\u5dde\u8def6\u53f7"}',
              'created_at'     => '2020-03-14 17:54:58',
              'updated_at'     => '2020-03-14 17:54:58',
             ],
             [
              'platform_sign'  => 'jhhy',
              'order_no'       => '20200314175459060478',
              'mobile'         => '18844446666',
              'user_id'        => 2,
              'amount'         => '100.0000',
              'before_balance' => '2999900.0000',
              'account_type'   => 1,
              'is_audit'       => 0,
              'status'         => 0,
              'month_total'    => '3000000.0000',
              'num_withdrawal' => 1,
              'num_top_up'     => 0,
              'account_snap'   => '{"owner_name":"\u4e9a\u7d22","card_number":"6228480402564890018","branch":"\u82cf\u5dde\u8def6\u53f7"}',
              'created_at'     => '2020-03-14 17:54:59',
              'updated_at'     => '2020-03-14 17:54:59',
             ],
             [
              'platform_sign'  => 'jhhy',
              'order_no'       => '20200314175500071841',
              'mobile'         => '18844446666',
              'user_id'        => 2,
              'amount'         => '100.0000',
              'before_balance' => '2999800.0000',
              'account_type'   => 1,
              'is_audit'       => 0,
              'status'         => 0,
              'month_total'    => '3000000.0000',
              'num_withdrawal' => 2,
              'num_top_up'     => 0,
              'account_snap'   => '{"owner_name":"\u4e9a\u7d22","card_number":"6228480402564890018","branch":"\u82cf\u5dde\u8def6\u53f7"}',
              'created_at'     => '2020-03-14 17:55:00',
              'updated_at'     => '2020-03-14 17:55:00',
             ],
             [
              'platform_sign'  => 'jhhy',
              'order_no'       => '20200314175500673346',
              'mobile'         => '18844446666',
              'user_id'        => 2,
              'amount'         => '100.0000',
              'before_balance' => '2999700.0000',
              'account_type'   => 1,
              'is_audit'       => 0,
              'status'         => 0,
              'month_total'    => '3000000.0000',
              'num_withdrawal' => 3,
              'num_top_up'     => 0,
              'account_snap'   => '{"owner_name":"\u4e9a\u7d22","card_number":"6228480402564890018","branch":"\u82cf\u5dde\u8def6\u53f7"}',
              'created_at'     => '2020-03-14 17:55:00',
              'updated_at'     => '2020-03-14 17:55:00',
             ],
             [
              'platform_sign'  => 'jhhy',
              'order_no'       => '20200314175501630261',
              'mobile'         => '18844446666',
              'user_id'        => 2,
              'amount'         => '100.0000',
              'before_balance' => '2999600.0000',
              'account_type'   => 1,
              'is_audit'       => 0,
              'status'         => 0,
              'month_total'    => '3000000.0000',
              'num_withdrawal' => 4,
              'num_top_up'     => 0,
              'account_snap'   => '{"owner_name":"\u4e9a\u7d22","card_number":"6228480402564890018","branch":"\u82cf\u5dde\u8def6\u53f7"}',
              'created_at'     => '2020-03-14 17:55:01',
              'updated_at'     => '2020-03-14 17:55:01',
             ],
            ],
        );
    }
}
