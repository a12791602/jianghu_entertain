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
                'id' => 2,
                'name' => 'bb',
                'sign' => 'b',
                'owner_id' => 19,
                'status' => 1,
            ],
        );
    }
}
