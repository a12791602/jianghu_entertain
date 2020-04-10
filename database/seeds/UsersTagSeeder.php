<?php

use App\Models\User\UsersTag;
use Illuminate\Database\Seeder;

/**
 * Class UsersTagSeeder
 */
class UsersTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UsersTag::insert(
            [
             [
              'platform_sign' => 'JHHY',
              'title'         => '普通会员',
              'no_withdraw'   => 0,
              'no_login'      => 0,
              'no_play'       => 0,
              'no_promote'    => 0,
              'created_at'    => '2019-12-26 13:22:04',
              'updated_at'    => '2019-12-28 13:29:07',
             ],
             [
              'platform_sign' => 'JHHY',
              'title'         => '风险会员',
              'no_withdraw'   => 0,
              'no_login'      => 0,
              'no_play'       => 1,
              'no_promote'    => 1,
              'created_at'    => '2019-12-26 13:22:16',
              'updated_at'    => '2019-12-26 13:22:16',
             ],
             [
              'platform_sign' => 'JHHY',
              'title'         => '钻石会员',
              'no_withdraw'   => 0,
              'no_login'      => 0,
              'no_play'       => 0,
              'no_promote'    => 0,
              'created_at'    => '2019-12-26 13:22:16',
              'updated_at'    => '2019-12-26 13:22:16',
             ],
            ],
        );
    }
}
