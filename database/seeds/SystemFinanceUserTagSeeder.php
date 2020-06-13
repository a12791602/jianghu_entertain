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
              'id'                 => 1,
              'platform_id'        => 1,
              'is_online'          => 1,
              'online_finance_id'  => 1,
              'offline_finance_id' => 0,
              'tag_id'             => '["1","2","3"]',
              'created_at'         => null,
              'updated_at'         => null,
             ],
             [
              'id'                 => 2,
              'platform_id'        => 1,
              'is_online'          => 0,
              'online_finance_id'  => 0,
              'offline_finance_id' => 1,
              'tag_id'             => '["1","2","3"]',
              'created_at'         => null,
              'updated_at'         => null,
             ],
             [
              'id'                 => 3,
              'platform_id'        => 1,
              'is_online'          => 0,
              'online_finance_id'  => 0,
              'offline_finance_id' => 2,
              'tag_id'             => '["1","2","3"]',
              'created_at'         => null,
              'updated_at'         => null,
             ],
             [
              'id'                 => 4,
              'platform_id'        => 1,
              'is_online'          => 0,
              'online_finance_id'  => 0,
              'offline_finance_id' => 3,
              'tag_id'             => '[3]',
              'created_at'         => '2020-06-01 16:12:29',
              'updated_at'         => '2020-06-01 16:12:29',
             ],
             [
              'id'                 => 5,
              'platform_id'        => 1,
              'is_online'          => 1,
              'online_finance_id'  => 2,
              'offline_finance_id' => 0,
              'tag_id'             => '["1","2","3"]',
              'created_at'         => '2020-06-13 17:41:37',
              'updated_at'         => '2020-06-13 17:41:37',
             ],
             [
              'id'                 => 6,
              'platform_id'        => 1,
              'is_online'          => 1,
              'online_finance_id'  => 3,
              'offline_finance_id' => 0,
              'tag_id'             => '["1","2","3"]',
              'created_at'         => '2020-06-13 17:43:41',
              'updated_at'         => '2020-06-13 17:43:41',
             ],
             [
              'id'                 => 7,
              'platform_id'        => 1,
              'is_online'          => 1,
              'online_finance_id'  => 4,
              'offline_finance_id' => 0,
              'tag_id'             => '["1","2","3"]',
              'created_at'         => '2020-06-13 17:45:02',
              'updated_at'         => '2020-06-13 17:45:02',
             ],
             [
              'id'                 => 8,
              'platform_id'        => 1,
              'is_online'          => 1,
              'online_finance_id'  => 5,
              'offline_finance_id' => 0,
              'tag_id'             => '["1","2","3"]',
              'created_at'         => '2020-06-13 17:46:26',
              'updated_at'         => '2020-06-13 17:46:26',
             ],
            ],
        );
    }
}
