<?php

use App\Models\Report\ReportDayGameVendor;
use Illuminate\Database\Seeder;

/**
 * Class ReportDayGameVendorSeeder
 */
class ReportDayGameVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ReportDayGameVendor::insert(
            [
             [
              'id'               => 1,
              'game_vendor_sign' => 'VR',
              'bet'              => 171,
              'win_money'        => 126,
              'tax'              => 0,
              'effective_bet'    => 45,
              'rebate'           => 0.045,
              'commission'       => 0,
              'day'              => '2020-05-08',
              'created_at'       => '2020-06-05 21:15:38',
              'updated_at'       => '2020-06-05 21:15:38',
             ],
            ],
        );
    }
}
