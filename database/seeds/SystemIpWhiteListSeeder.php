<?php

use App\Models\Systems\SystemIpWhiteList;
use Illuminate\Database\Seeder;

/**
 * Class SystemIpWhiteListSeeder
 */
class SystemIpWhiteListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemIpWhiteList::insert(
            [
             [
              'ips'               => '["10.10.10.10","10.10.20.101"]',
              'type'              => 2,
              'finance_vendor_id' => 1,
              'game_vendor_id'    => null,
             ],
             [
              'ips'               => '["10.10.10.13","10.10.50.15"]',
              'type'              => 1,
              'finance_vendor_id' => null,
              'game_vendor_id'    => 1,
             ],
            ],
        );
    }
}
