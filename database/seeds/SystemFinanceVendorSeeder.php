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
              'name'       => '天道支付',
              'sign'       => 'td',
              'status'     => 1,
              'author_id'  => 2,
              'created_at' => '2020-04-10 22:40:41',
              'updated_at' => '2020-04-10 22:40:41',
             ],
            ],
        );
    }
}
