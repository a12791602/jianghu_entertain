<?php

use App\Models\User\FrontendUsersAccountsTypesGroup;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUserAccountTypesGroupSeeder
 */
class FrontendUserAccountTypesGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUsersAccountsTypesGroup::insert(
            [
             [
              'id'         => 1,
              'group_name' => '充值',
             ],
             [
              'id'         => 2,
              'group_name' => '提现',
             ],
             [
              'id'         => 3,
              'group_name' => '游戏',
             ],
             [
              'id'         => 4,
              'group_name' => '活动',
             ],
             [
              'id'         => 5,
              'group_name' => '返佣',
             ],
            ],
        );
    }
}
