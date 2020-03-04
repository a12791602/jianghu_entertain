<?php

use App\Models\Platform\GamePlatform;
use Illuminate\Database\Seeder;

/**
 * Class GamePlatformSeeder
 */
class GamePlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        GamePlatform::insert(
            [
             [
              'platform_id'  => 1,
              'game_id'      => 1,
              'status'       => 1,
              'sort'         => 1,
              'hot_new'      => 0,
              'device'       => 2,
              'is_recommend' => 0,
              'icon'         => null,
             ],
             [
              'platform_id'  => 1,
              'game_id'      => 2,
              'status'       => 1,
              'sort'         => 3,
              'hot_new'      => 1,
              'device'       => 2,
              'is_recommend' => 0,
              'icon'         => null,
             ],
             [
              'platform_id'  => 1,
              'game_id'      => 3,
              'status'       => 1,
              'sort'         => 1,
              'hot_new'      => 1,
              'device'       => 2,
              'is_recommend' => 0,
              'icon'         => null,
             ],
            ],
        );
    }
}
