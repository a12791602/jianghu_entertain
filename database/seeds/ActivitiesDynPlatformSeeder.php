<?php

use App\Models\Activity\ActivitiesDynPlatform;
use Illuminate\Database\Seeder;

/**
 * Class ActivitiesDynPlatformSeeder
 */
class ActivitiesDynPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ActivitiesDynPlatform::insert(
            [
             [
              'id'              => 1,
              'activity_dyn_id' => 3,
              'platform_id'     => 1,
              'status'          => 1,
             ],
            ],
        );
    }
}
