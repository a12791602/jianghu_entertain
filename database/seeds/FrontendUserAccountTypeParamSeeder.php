<?php

use App\Models\User\FrontendUsersAccountsTypesParam;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUserAccountTypeParamSeeder
 */
class FrontendUserAccountTypeParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUsersAccountsTypesParam::insert(
            [
                [
                    'id' => 1,
                    'label' => '金额',
                    'param' => 'amount',
                    'compatible' => 1,
                ],
                [
                    'id' => 2,
                    'label' => '用户id',
                    'param' => 'user_id',
                    'compatible' => 1,
                ],
                [
                    'id' => 3,
                    'label' => '投注id',
                    'param' => 'project_id',
                    'compatible' => 1,
                ],
                [
                    'id' => 4,
                    'label' => '彩种id',
                    'param' => 'lottery_id',
                    'compatible' => 1,
                ],
                [
                    'id' => 5,
                    'label' => '彩种玩法id',
                    'param' => 'method_id',
                    'compatible' => 1,
                ],
                [
                    'id' => 6,
                    'label' => '彩种奖期',
                    'param' => 'issue',
                    'compatible' => 1,
                ],
                [
                    'id' => 7,
                    'label' => '转账的用户id',
                    'param' => 'from_id',
                    'compatible' => 1,
                ],
                [
                    'id' => 8,
                    'label' => '转账的总代id',
                    'param' => 'from_admin_id',
                    'compatible' => 1,
                ],
                [
                    'id' => 9,
                    'label' => '接受转账的用户id',
                    'param' => 'to_id',
                    'compatible' => 1,
                ],
                [
                    'id' => 10,
                    'label' => '娱乐城游戏Code',
                    'param' => 'casino_game_code',
                    'compatible' => 0,
                ],
                [
                    'id' => 11,
                    'label' => '娱乐城游戏平台',
                    'param' => 'casino_game_plat',
                    'compatible' => 0,
                ],
                [
                    'id' => 12,
                    'label' => '娱乐城游戏类型',
                    'param' => 'casino_game_category',
                    'compatible' => 0,
                ],
            ],
        );
    }
}
