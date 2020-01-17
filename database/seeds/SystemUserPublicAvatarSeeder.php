<?php

use App\Models\Systems\SystemUserPublicAvatar;
use Illuminate\Database\Seeder;

/**
 * Class SystemUserPublicAvatarSeeder
 */
class SystemUserPublicAvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemUserPublicAvatar::insert(
            [
             [
              'id'       => 1,
              'pic_path' => 'uploads/test/avatar/2020-01-08/7c0a218b4f651a9c6aeded81fc032ef6.png',
             ],
            ],
        );
    }
}
