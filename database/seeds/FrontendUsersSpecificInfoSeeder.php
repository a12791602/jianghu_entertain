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
              'id'             => 1,
              'nickname'       => 'harriszhongdai',
              'avatar'         => '1',
              'email'          => '1823444@qq.com',
              'zip_code'       => '233333',
              'address'        => '朝歌',
              'register_type'  => 0,
              'total_members'  => 20,
              'user_id'        => 1,
              'level'          => 6,
              'experience'     => 1500,
              'promotion_gift' => 1,
              'weekly_gift'    => 1,
              'domain'         => null,
              'created_at'     => null,
              'updated_at'     => null,
             ],
             [
              'id'             => 2,
              'nickname'       => '亚索9kp',
              'avatar'         => '1',
              'email'          => 'test@qq.com',
              'zip_code'       => '233333',
              'address'        => 'test city',
              'register_type'  => 0,
              'total_members'  => 15,
              'user_id'        => 2,
              'level'          => 6,
              'experience'     => 1500,
              'promotion_gift' => 1,
              'weekly_gift'    => 1,
              'domain'         => null,
              'created_at'     => null,
              'updated_at'     => '2020-01-28 22:11:09',
             ],
             [
              'id'             => 3,
              'nickname'       => '亚索49',
              'avatar'         => '1',
              'email'          => 'test@qq.com',
              'zip_code'       => '233333',
              'address'        => 'test city',
              'register_type'  => 0,
              'total_members'  => 15,
              'user_id'        => 3,
              'level'          => 6,
              'experience'     => 1500,
              'promotion_gift' => 1,
              'weekly_gift'    => 1,
              'domain'         => null,
              'created_at'     => null,
              'updated_at'     => '2020-01-21 14:52:26',
             ],
            ],
        );
    }
}
