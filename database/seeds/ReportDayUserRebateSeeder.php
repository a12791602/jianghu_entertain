<?php

use App\Models\Report\ReportDayUserRebate;
use Illuminate\Database\Seeder;

/**
 * Class ReportDayUserRebateSeeder
 */
class ReportDayUserRebateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ReportDayUserRebate::insert(
            [
             [
              'id'               => 1,
              'platform_sign'    => 'JHHY',
              'mobile'           => 18844446666,
              'guid'             => '18967200',
              'game_vendor_sign' => 'VR',
              'bet'              => 171,
              'effective_bet'    => 45,
              'rebate'           => 0,
              'percent'          => 0,
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
              'bet'              => 40,
              'effective_bet'    => 30,
              'rebate'           => 0,
              'percent'          => 0,
              'day'              => '2020-05-15',
              'created_at'       => '2020-05-29 17:50:38',
              'updated_at'       => '2020-05-29 17:50:38',
             ],
            ],
        );
    }
}
