<?php

use App\Models\User\FrontendUsersSpecificInfo;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUserSpecificInfoSeeder
 */
class FrontendUserSpecificInfoSeeder extends Seeder
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
                    'nickname' => 'harriszhongdai',
                    'email' => '1823444@qq.com',
                    'zip_code' => 233333,
                    'address' => '朝歌',
                    'register_type' => 0,
                    'total_members' => 20,
                    'user_id' => 1,
                ],
                [
                    'nickname' => 'test',
                    'email' => 'test@qq.com',
                    'zip_code' => 233333,
                    'address' => 'test city',
                    'register_type' => 0,
                    'total_members' => 15,
                    'user_id' => 2,
                ],
            ],
        );
    }
}
