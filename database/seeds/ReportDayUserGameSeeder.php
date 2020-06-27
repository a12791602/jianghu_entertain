<?php

use App\Models\Report\ReportDayUserGame;
use Illuminate\Database\Seeder;

/**
 * Class ReportDayUserGameSeeder
 */
class ReportDayUserGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ReportDayUserGame::insert(
            [
             [
              'id'               => 1,
              'platform_sign'    => 'JHHY',
              'mobile'           => 18844446666,
              'guid'             => '18967200',
              'game_vendor_sign' => 'VR',
              'game_sign'        => '10002',
              'bet_money'        => 171,
              'effective_bet'    => 45,
              'win_money'        => 1,
              'our_net_win'      => 0,
              'rebate'           => 0.045,
              'commission'       => 0,
              'day'              => '2020-05-08',
              'created_at'       => '2020-05-29 17:50:38',
              'updated_at'       => '2020-05-29 17:50:38',
             ],
             [
              'id'               => 2,
              'platform_sign'    => 'JHHY',
              'mobile'           => 18844446666,
              'guid'             => '18967200',
              'game_vendor_sign' => 'IM',
              'game_sign'        => 'IMSB',
              'bet_money'        => 40,
              'effective_bet'    => 30,
              'win_money'        => 13,
              'our_net_win'      => 0,
              'rebate'           => 0,
              'commission'       => 0,
              'day'              => '2020-05-15',
              'created_at'       => '2020-05-29 17:50:38',
              'updated_at'       => '2020-05-29 17:50:38',
             ],
            ],
        );
    }
}
