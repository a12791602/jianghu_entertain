<?php

use App\Models\Report\ReportDayPlatformGameVendor;
use Illuminate\Database\Seeder;

/**
 * Class ReportDayPlatformGameVendorsSeeder
 */
class ReportDayPlatformGameVendorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ReportDayPlatformGameVendor::insert(
            [
             [
              'id'               => 1,
              'platform_sign'    => 'JHHY',
              'game_vendor_sign' => 'VR',
              'game_vendor_name' => 'VR视讯',
              'bet_money'        => 171,
              'effective_bet'    => 45,
              'win_money'        => 126,
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
