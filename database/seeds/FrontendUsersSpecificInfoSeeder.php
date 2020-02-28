<?php

use App\Models\User\FrontendUsersSpecificInfo;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUsersSpecificInfoSeeder
 */
class FrontendUsersSpecificInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUsersSpecificInfo::insert(
            [
             [
              'id'            => 1,
              'nickname'      => 'harriszhongdai',
              'avatar'        => 1,
              'email'         => '1823444@qq.com',
              'zip_code'      => '233333',
              'address'       => '朝歌',
              'register_type' => 0,
              'total_members' => 20,
              'user_id'       => 1,
              'level'         => 2,
              'experience'    => 2500,
             ],
             [
              'id'            => 2,
              'nickname'      => '亚索Suo',
              'avatar'        => 1,
              'email'         => 'sunshine@gmail.com',
              'zip_code'      => '1600',
              'address'       => 'State of California',
              'register_type' => 0,
              'total_members' => 15,
              'user_id'       => 2,
              'level'         => 1,
              'experience'    => 1500,
             ],
             [
              'id'            => 3,
              'nickname'      => '李青Lee',
              'avatar'        => 1,
              'email'         => 'test@qq.com',
              'zip_code'      => '233333',
              'address'       => 'test city',
              'register_type' => 0,
              'total_members' => 15,
              'user_id'       => 3,
              'level'         => 0,
              'experience'    => 500,
             ],
            ],
        );
    }
}
