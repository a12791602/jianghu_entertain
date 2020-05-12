<?php

use App\Models\Systems\StaticResource;
use Illuminate\Database\Seeder;

/**
 * Class StaticResourceSeeder
 */
class StaticResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        StaticResource::insert(
            [
             [
              'path'        => 'backend/static_resource/json/cron_job.json',
              'type'        => null,
              'table_name'  => null,
              'title'       => null,
              'description' => null,
              'static_type' => 2,
              'created_at'  => null,
              'updated_at'  => null,
             ],
             [
              'path'        => 'uploads/hqstatics/pic/icon/2020-05-11/ea20fb4e901364cbcb3919a4db8be238.png',
              'type'        => 1,
              'table_name'  => 'game_vendor',
              'title'       => 'game_vendor_icon',
              'description' => '游戏厂商 icon',
              'static_type' => 1,
              'created_at'  => '2020-05-11 20:50:32',
              'updated_at'  => '2020-05-11 20:50:32',
             ],
             [
              'path'        => 'uploads/hqstatics/pic/icon/2020-05-11/3d2dbe2c8402ea45c9ad71387d14c909.jpg',
              'type'        => null,
              'table_name'  => null,
              'title'       => null,
              'description' => null,
              'static_type' => 1,
              'created_at'  => '2020-05-11 20:52:07',
              'updated_at'  => '2020-05-11 20:52:07',
             ],
            ],
        );
    }
}
