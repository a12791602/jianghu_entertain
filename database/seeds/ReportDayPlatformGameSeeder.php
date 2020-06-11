<?php

use App\Models\Report\ReportDayPlatformGame;
use Illuminate\Database\Seeder;

/**
 * Class ReportDayPlatformGameSeeder
 */
class ReportDayPlatformGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ReportDayPlatformGame::insert(
            [
             [
              'id'               => 1,
              'platform_sign'    => 'JHHY',
              'game_sign'        => '10002',
              'game_name'        => '射兔神手',
              'game_vendor_sign' => 'VR',
              'bet_money'        => 171.0000,
              'effective_bet'    => 45.0000,
              'win_money'        => 126.0000,
              'our_net_win'      => 0,
              'commission'       => 0,
              'day'              => '2020-05-08',
              'created_at'       => '2020-05-21 17:48:13',
              'updated_at'       => '2020-05-21 17:48:13',
             ],
            ],
        );
    }
}
