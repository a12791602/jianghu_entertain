<?php

use App\Models\Game\GameTypePlatform;
use Illuminate\Database\Seeder;

/**
 * Class GameTypePlatformSeeder
 */
class GameTypePlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GameTypePlatform::insert(
            [
                [
                    'platform_id' => 1,
                    'type_id' => 1,
                    'device' => 2,
                    'status' => 1,
                ],
                [
                    'platform_id' => 1,
                    'type_id' => 2,
                    'device' => 2,
                    'status' => 1,
                ],
                [
                    'platform_id' => 1,
                    'type_id' => 3,
                    'device' => 2,
                    'status' => 1,
                ],
                [
                    'platform_id' => 1,
                    'type_id' => 4,
                    'device' => 2,
                    'status' => 1,
                ],
                [
                    'platform_id' => 1,
                    'type_id' => 5,
                    'device' => 2,
                    'status' => 1,
                ],
                [
                    'platform_id' => 1,
                    'type_id' => 6,
                    'device' => 2,
                    'status' => 1,
                ],
            ],
        );
    }
}
