<?php

use App\Models\User\FrontendUsersAudit;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUsersAuditSeeder
 */
class FrontendUsersAuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUsersAudit::insert(
            [
             [
              'id'            => 1,
              'mobile'        => '18844446666',
              'guid'          => '18967200',
              'platform_sign' => 'jhhy',
              'order_number'  => 'jhhy3a14e9faa953',
              'type'          => '充值',
              'amount'        => '1000.0000',
              'demand_bet'    => '1000.0000',
              'achieved_bet'  => '0.0000',
              'status'        => 0,
              'achieved_time' => null,
              'created_at'    => '2020-04-11 15:57:12',
              'updated_at'    => '2020-04-11 15:57:12',
             ],
             [
              'id'            => 2,
              'mobile'        => '18844446666',
              'guid'          => '18967200',
              'platform_sign' => 'jhhy',
              'order_number'  => 'jhhy0d1fbd3522d3',
              'type'          => '充值',
              'amount'        => '1000.0000',
              'demand_bet'    => '1000.0000',
              'achieved_bet'  => '0.0000',
              'status'        => 0,
              'achieved_time' => null,
              'created_at'    => '2020-04-11 16:12:48',
              'updated_at'    => '2020-04-11 16:12:48',
             ],
            ],
        );
    }
}
