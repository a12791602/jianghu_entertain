<?php

use App\Models\User\FrontendUsersAccountsTypesParam;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUsersAccountsTypesParamSeeder
 */
class FrontendUsersAccountsTypesParamSeeder extends Seeder
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
              'id'             => 1,
              'label'          => '金额',
              'param'          => 'amount',
              'rule'           => 'required|numeric|gt:0',
              'is_search_ease' => 1,
             ],
             [
              'id'             => 2,
              'label'          => '用户id',
              'param'          => 'user_id',
              'rule'           => 'required|integer|exists:frontend_users,id',
              'is_search_ease' => 1,
             ],
             [
              'id'             => 3,
              'label'          => '投注id',
              'param'          => 'project_id',
              'rule'           => 'required|integer|exists:projects,id',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 4,
              'label'          => '彩种id',
              'param'          => 'lottery_id',
              'rule'           => 'required|integer',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 5,
              'label'          => '彩种玩法id',
              'param'          => 'method_id',
              'rule'           => 'required|integer',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 6,
              'label'          => '彩种奖期',
              'param'          => 'issue',
              'rule'           => 'required|string|max:32',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 7,
              'label'          => '转账的用户id',
              'param'          => 'from_id',
              'rule'           => 'required|integer|exists:frontend_users,id',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 8,
              'label'          => '转账的总代id',
              'param'          => 'from_admin_id',
              'rule'           => 'required|integer',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 9,
              'label'          => '接受转账的用户id',
              'param'          => 'to_id',
              'rule'           => 'required|integer|exists:frontend_users,id',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 10,
              'label'          => '游戏series_id',
              'param'          => 'game_series_id',
              'rule'           => 'required|integer|exists:game_platforms,id',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 11,
              'label'          => '游戏厂商id',
              'param'          => 'game_vendor_id',
              'rule'           => 'required|integer|exists:game_vendor_platforms,id',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 12,
              'label'          => '游戏类型id',
              'param'          => 'game_type_id',
              'rule'           => 'required|integer|exists:game_type_platforms,id',
              'is_search_ease' => 0,
             ],
             [
              'id'             => 13,
              'label'          => '活动标识',
              'param'          => 'activity_sign',
              'rule'           => 'required|string|max:32',
              'is_search_ease' => 0,
             ],
            ],
        );
    }
}
