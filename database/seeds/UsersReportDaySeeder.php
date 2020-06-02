<?php

use App\Models\User\UsersReportDay;
use Illuminate\Database\Seeder;

/**
 * Class UsersReportDaySeeder
 */
class UsersReportDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UsersReportDay::insert(
            [
             [
              'platform_sign'     => 'JHHY',
              'mobile'            => 18844446666,
              'guid'              => 18967200,
              'recharge_sum'      => 0,
              'recharge_num'      => 0,
              'withdraw_sum'      => 0,
              'withdraw_num'      => 0,
              'bet_sum'           => 171,
              'bet_num'           => 5,
              'reduced_sum'       => 0,
              'effective_bet_sum' => 45,
              'commission'        => 0,
              'rebate'            => 0,
              'activity_sum'      => 0,
              'game_win_sum'      => 126,
              'day'               => '2020-05-07',
              'created_at'        => '2020-05-22 16:29:00',
              'updated_at'        => '2020-05-22 16:29:00',
             ],
             [
              'platform_sign'     => 'JHHY',
              'mobile'            => 18844446666,
              'guid'              => 18967200,
              'recharge_sum'      => 0,
              'recharge_num'      => 0,
              'withdraw_sum'      => 0,
              'withdraw_num'      => 0,
              'bet_sum'           => 40,
              'bet_num'           => 4,
              'reduced_sum'       => 0,
              'effective_bet_sum' => 30,
              'commission'        => 0,
              'rebate'            => 0,
              'activity_sum'      => 0,
              'game_win_sum'      => 13,
              'day'               => '2020-05-11',
              'created_at'        => '2020-05-22 16:29:00',
              'updated_at'        => '2020-05-22 16:29:00',
             ],
            ],
        );
    }
}
