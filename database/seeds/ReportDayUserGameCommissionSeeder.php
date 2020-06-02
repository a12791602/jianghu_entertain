<?php

use App\Models\Report\ReportDayUserGameCommission;
use Illuminate\Database\Seeder;

/**
 * Class ReportDayUserGameCommissionSeeder
 */
class ReportDayUserGameCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ReportDayUserGameCommission::insert(
            [
             [
              'id'               => 1,
              'platform_sign'    => 'JHHY',
              'mobile'           => 18844446666,
              'guid'             => '18967200',
              'game_vendor_sign' => 'VR',
              'game_sign'        => '10002',
              'bet'              => 171,
              'effective_bet'    => 45,
              'rebate'           => 0.045,
              'day'              => '2020-05-08',
              'created_at'       => '2020-05-29 17:50:38',
              'updated_at'       => '2020-05-29 17:50:38',
             ],
            ],
        );
    }
}
