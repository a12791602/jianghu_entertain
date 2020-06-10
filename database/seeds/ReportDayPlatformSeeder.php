<?php

use App\Models\Report\ReportDayPlatform;
use Illuminate\Database\Seeder;

/**
 * Class ReportDayPlatformSeeder
 */
class ReportDayPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ReportDayPlatform::insert(
            [
             [
              'platform_sign' => 'JHHY',
              'recharge_sum'  => 0,
              'withdraw_sum'  => 8888,
              'reduced_sum'   => 0,
              'activity_sum'  => 0,
              'day'           => '2020-05-25',
              'created_at'    => '2020-06-08 22:11:50',
              'updated_at'    => '2020-06-08 22:11:50',
             ],
             [
              'platform_sign' => 'JHHY',
              'recharge_sum'  => 1,
              'withdraw_sum'  => 0,
              'reduced_sum'   => 0,
              'activity_sum'  => 0,
              'day'           => '2020-06-08',
              'created_at'    => '2020-06-08 22:11:50',
              'updated_at'    => '2020-06-08 22:11:50',
             ],
            ],
        );
    }
}
