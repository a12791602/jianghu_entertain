<?php

use App\Models\Activity\ActivitiesDynType;
use Illuminate\Database\Seeder;

/**
 * Class ActivitiesDynTypeSeeder
 */
class ActivitiesDynTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        ActivitiesDynType::insert(
            [
             [
              'id'         => 1,
              'type_name'  => '注册相关活动',
              'type_title' => 'registration',
              'created_at' => null,
              'updated_at' => null,
             ],
            ],
        );
    }
}
