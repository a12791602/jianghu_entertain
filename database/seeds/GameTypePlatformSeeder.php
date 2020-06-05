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
              'id'          => 1,
              'platform_id' => 1,
              'type_id'     => 1,
              'device'      => '2',
              'status'      => 1,
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'id'          => 2,
              'platform_id' => 1,
              'type_id'     => 2,
              'device'      => '2',
              'status'      => 1,
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'id'          => 3,
              'platform_id' => 1,
              'type_id'     => 3,
              'device'      => '2',
              'status'      => 1,
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'id'          => 4,
              'platform_id' => 1,
              'type_id'     => 4,
              'device'      => '2',
              'status'      => 1,
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'id'          => 5,
              'platform_id' => 1,
              'type_id'     => 5,
              'device'      => '2',
              'status'      => 1,
              'created_at'  => null,
              'updated_at'  => null,
             ],
            ],
        );
    }
}
