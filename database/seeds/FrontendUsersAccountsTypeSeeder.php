<?php

use App\Models\User\FrontendUsersAccountsType;
use Illuminate\Database\Seeder;

/**
 * Class FrontendUsersAccountsTypeSeeder
 */
class FrontendUsersAccountsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        FrontendUsersAccountsType::insert(
            [
             [
              'name'          => '充值',
              'sign'          => 'recharge',
              'in_out'        => 1,
              'param'         => '1,2',
              'frozen_type'   => 0,
              'group_type_id' => 1,
              'admin_id'      => 0,
             ],
             [
              'name'          => '提现冻结',
              'sign'          => 'withdraw_frozen',
              'in_out'        => 2,
              'param'         => '1,2',
              'frozen_type'   => 1,
              'group_type_id' => 2,
              'admin_id'      => 0,
             ],
             [
              'name'          => '提现解冻',
              'sign'          => 'withdraw_un_frozen',
              'in_out'        => 1,
              'param'         => '1,2',
              'frozen_type'   => 2,
              'group_type_id' => 2,
              'admin_id'      => 0,
             ],
             [
              'name'          => '提现成功',
              'sign'          => 'withdraw_finish',
              'in_out'        => 2,
              'param'         => '1,2',
              'frozen_type'   => 4,
              'group_type_id' => 2,
              'admin_id'      => 0,
             ],
             [
              'name'          => '游戏三方转出',
              'sign'          => 'game_out',
              'in_out'        => 2,
              'param'         => '1,2,11,12',
              'frozen_type'   => 0,
              'group_type_id' => 3,
              'admin_id'      => 0,
             ],
             [
              'name'          => '游戏三方转入',
              'sign'          => 'game_in',
              'in_out'        => 1,
              'param'         => '1,2,11,12',
              'frozen_type'   => 0,
              'group_type_id' => 3,
              'admin_id'      => 0,
             ],
             [
              'name'          => '游戏真实扣款',
              'sign'          => 'game_real_cost',
              'in_out'        => 2,
              'param'         => '1,2,11',
              'frozen_type'   => 0,
              'group_type_id' => 3,
              'admin_id'      => 0,
             ],
             [
              'name'          => '下级返点',
              'sign'          => 'point_from_child',
              'in_out'        => 1,
              'param'         => '1,2,3,4,5,6,7,8',
              'frozen_type'   => 0,
              'group_type_id' => 5,
              'admin_id'      => 0,
             ],
             [
              'name'          => '活动礼金',
              'sign'          => 'gift',
              'in_out'        => 1,
              'param'         => '1,2',
              'frozen_type'   => 0,
              'group_type_id' => 4,
              'admin_id'      => 0,
             ],
             [
              'name'          => '上级充值',
              'sign'          => 'recharge_from_parent',
              'in_out'        => 1,
              'param'         => '1,2,7',
              'frozen_type'   => 0,
              'group_type_id' => 1,
              'admin_id'      => 0,
             ],
             [
              'name'          => '上级分红',
              'sign'          => 'dividend_from_parent',
              'in_out'        => 1,
              'param'         => '1,2,7',
              'frozen_type'   => 0,
              'group_type_id' => 0,
              'admin_id'      => 0,
             ],
             [
              'name'          => '人工充值',
              'sign'          => 'artificial_recharge',
              'in_out'        => 1,
              'param'         => '1,2',
              'frozen_type'   => 0,
              'group_type_id' => 1,
              'admin_id'      => 0,
             ],
             [
              'name'          => '人工扣款',
              'sign'          => 'artificial_deduction',
              'in_out'        => 2,
              'param'         => '1,2',
              'frozen_type'   => 0,
              'group_type_id' => 0,
              'admin_id'      => 0,
             ],
             [
              'name'          => '游戏返点',
              'sign'          => 'bet_commission',
              'in_out'        => 1,
              'param'         => '1,2,3,4,6',
              'frozen_type'   => 0,
              'group_type_id' => 3,
              'admin_id'      => 0,
             ],
             [
              'name'          => '下级游戏反佣',
              'sign'          => 'commission',
              'in_out'        => 1,
              'param'         => '1,2,3,4,6',
              'frozen_type'   => 0,
              'group_type_id' => 5,
              'admin_id'      => 0,
             ],
             [
              'name'          => '游戏三方单一转出',
              'sign'          => 'game_thier_bet',
              'in_out'        => 2,
              'param'         => '1,2,3,11,12',
              'frozen_type'   => 1,
              'group_type_id' => 3,
              'admin_id'      => 0,
             ],
             [
              'name'          => '游戏三方单一套现',
              'sign'          => 'game_thier_gain',
              'in_out'        => 1,
              'param'         => '1,2,3,11,12,14',
              'frozen_type'   => 3,
              'group_type_id' => 3,
              'admin_id'      => 0,
             ],
             // [
             //  'name'          => '系统扣减',
             //  'sign'          => 'system_reduce',
             //  'in_out'        => 2,
             //  'param'         => '8',
             //  'frozen_type'   => 0,
             //  'group_type_id' => 0,
             //  'admin_id'      => 0,
             // ],
             // [
             //  'name'          => '系统活动转账',
             //  'sign'          => 'system_claim',
             //  'in_out'        => 1,
             //  'param'         => '8',
             //  'frozen_type'   => 0,
             //  'group_type_id' => 0,
             //  'admin_id'      => 0,
             // ],
             // [
             //  'name'          => '撤单返款',
             //  'sign'          => 'cancel_order',
             //  'in_out'        => 1,
             //  'param'         => '3,4,5,6',
             //  'frozen_type'   => 2,
             //  'group_type_id' => 0,
             //  'admin_id'      => 0,
             // ],
            ],
        );
    }
}
