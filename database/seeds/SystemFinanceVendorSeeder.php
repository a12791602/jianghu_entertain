<?php

use App\Models\Finance\SystemFinanceVendor;
use Illuminate\Database\Seeder;

/**
 * Class SystemFinanceVendorSeeder
 */
class SystemFinanceVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemFinanceVendor::insert(
            [
             [
              'name'          => '天道支付',
              'sign'          => 'td',
              'whitelist_ips' => '["10.10.57.10"]',
              'status'        => 1,
              'author_id'     => 2,
             ],
            ],
        );
    }
}
