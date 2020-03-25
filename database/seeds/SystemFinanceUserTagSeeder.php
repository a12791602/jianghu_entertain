<?php

use App\Models\Finance\SystemFinanceUserTag;
use Illuminate\Database\Seeder;

/**
 * Class SystemFinanceUserTagSeeder
 */
class SystemFinanceUserTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemFinanceUserTag::insert(
            [
             [
              'platform_id'        => 1,
              'is_online'          => 1,
              'online_finance_id'  => 1,
              'offline_finance_id' => 0,
              'tag_id'             => '["1","2","3"]',
             ],
             [
              'platform_id'        => 1,
              'is_online'          => 0,
              'online_finance_id'  => 0,
              'offline_finance_id' => 1,
              'tag_id'             => '["1","2","3"]',
             ],
             [
              'platform_id'        => 1,
              'is_online'          => 0,
              'online_finance_id'  => 0,
              'offline_finance_id' => 2,
              'tag_id'             => '["1","2"]',
             ],
            ],
        );
    }
}
