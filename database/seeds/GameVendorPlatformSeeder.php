<?php

use App\Models\Game\GameVendorPlatform;
use Illuminate\Database\Seeder;

/**
 * Class GameVendorPlatformSeeder
 */
class GameVendorPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GameVendorPlatform::insert(
            [
                [
                    'platform_id' => 2,
                    'vendor_id' => 1,
                    'sort' => 0,
                    'is_maintain' => 0,
                    'status' => 0,
                    'device' => 2,
                ],
                [
                    'platform_id' => 2,
                    'vendor_id' => 1,
                    'sort' => 0,
                    'is_maintain' => 0,
                    'status' => 0,
                    'device' => 3,
                ],
                [
                    'platform_id' => 2,
                    'vendor_id' => 1,
                    'sort' => 0,
                    'is_maintain' => 0,
                    'status' => 0,
                    'device' => 1,
                ],
                [
                    'platform_id' => 2,
                    'vendor_id' => 2,
                    'sort' => 0,
                    'is_maintain' => 0,
                    'status' => 0,
                    'device' => 2,
                ],
                [
                    'platform_id' => 2,
                    'vendor_id' => 2,
                    'sort' => 0,
                    'is_maintain' => 0,
                    'status' => 0,
                    'device' => 3,
                ],
                [
                    'platform_id' => 2,
                    'vendor_id' => 2,
                    'sort' => 0,
                    'is_maintain' => 0,
                    'status' => 0,
                    'device' => 1,
                ],
                [
                    'platform_id' => 4,
                    'vendor_id' => 2,
                    'sort' => 0,
                    'is_maintain' => 0,
                    'status' => 0,
                    'device' => 2,
                ],
                [
                    'platform_id' => 4,
                    'vendor_id' => 2,
                    'sort' => 0,
                    'is_maintain' => 0,
                    'status' => 0,
                    'device' => 3,
                ],
                [
                    'platform_id' => 4,
                    'vendor_id' => 2,
                    'sort' => 0,
                    'is_maintain' => 0,
                    'status' => 0,
                    'device' => 1,
                ],
            ],
        );
    }
}
