<?php

use App\Models\Systems\SystemPlatform;
use Illuminate\Database\Seeder;

/**
 * Class SystemPlatformSeeder
 */
class SystemPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemPlatform::insert(
            [
                'id' => 1,
                'name' => '测试平台',
                'sign' => 'test',
                'owner_id' => 1,
                'status' => 1,
                'created_at' => '2020-01-01 00:00:00',
            ],
        );
    }
}
