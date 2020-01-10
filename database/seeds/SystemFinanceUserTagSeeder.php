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
                    'platform_id' => 1,
                    'is_online' => 1,
                    'finance_id' => 1,
                    'tag_id' => 4,
                ],
                [
                    'platform_id' => 1,
                    'is_online' => 1,
                    'finance_id' => 1,
                    'tag_id' => 5,
                ],
                [
                    'platform_id' => 1,
                    'is_online' => 0,
                    'finance_id' => 1,
                    'tag_id' => 4,
                ],
                [
                    'platform_id' => 1,
                    'is_online' => 0,
                    'finance_id' => 1,
                    'tag_id' => 5,
                ],
                [
                    'platform_id' => 1,
                    'is_online' => 0,
                    'finance_id' => 2,
                    'tag_id' => 4,
                ],
                [
                    'platform_id' => 2,
                    'is_online' => 0,
                    'finance_id' => 2,
                    'tag_id' => 5,
                ],
            ],
        );
    }
}
