<?php

use App\Models\Activity\ActivitiesDynSystem;
use Illuminate\Database\Seeder;

/**
 * Class ActivitiesDynSystemSeeder
 */
class ActivitiesDynSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ActivitiesDynSystem::insert(
            [
             [
              'id'             => 1,
              'name'           => '幸运转盘',
              'sign'           => 'TURNTABLE',
              'title'          => null,
              'type_id'        => null,
              'model'          => null,
              'last_editor_id' => 0,
              'status'         => 1,
              'created_at'     => '2020-05-30 18:22:30',
              'updated_at'     => '2020-05-30 18:22:30',
             ],
             [
              'id'             => 2,
              'name'           => '抢红包',
              'sign'           => 'RED',
              'title'          => null,
              'type_id'        => null,
              'model'          => null,
              'last_editor_id' => 0,
              'status'         => 1,
              'created_at'     => '2020-05-30 18:22:30',
              'updated_at'     => '2020-05-30 18:22:30',
             ],
             [
              'id'             => 3,
              'name'           => ' 注册送礼',
              'sign'           => 'REG_GIFT',
              'title'          => 'FirstRegistrationGifts',
              'type_id'        => 1,
              'model'          => 'ActivitiesConfigRegFirstimeRandom',
              'last_editor_id' => 0,
              'status'         => 0,
              'created_at'     => '2020-05-30 18:33:43',
              'updated_at'     => '2020-05-30 18:33:43',
             ],
            ],
        );
    }
}
