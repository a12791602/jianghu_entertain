<?php

use App\Models\Systems\SystemConfigurationStandard;
use Illuminate\Database\Seeder;

/**
 * Class SystemConfigurationSeeder
 */
class SystemConfigurationStandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemConfigurationStandard::insert(
            [
             [
              'sign'   => 'is_crypt_data',
              'name'   => '传输数据是否加密',
              'value'  => 1,
              'status' => 1,
             ],
             [
              'sign'   => 'login_error_num',
              'name'   => '登录密码错误限制次数',
              'value'  => 3,
              'status' => 1,
             ],
             [
              'sign'   => 'register_invite_code',
              'name'   => '注册邀请码',
              'value'  => 0,
              'status' => 1,
             ],
             [
              'sign'   => 'system_maintenance',
              'name'   => '系统维护总开关',
              'value'  => 0,
              'status' => 1,
             ],
             [
              'sign'   => 'commission',
              'name'   => '是否开启洗码',
              'value'  => 0,
              'status' => 1,
             ],
             [
              'sign'   => 'chat_user_grade',
              'name'   => '聊天室用户等级',
              'value'  => 0,
              'status' => 1,
             ],
             [
              'sign'   => 'play_min_recharge',
              'name'   => '最低充值多少才能游戏',
              'value'  => 30,
              'status' => 1,
             ],
             [
              'sign'   => 'withdraw_error_num',
              'name'   => '取款密码错误次数限制',
              'value'  => 3,
              'status' => 1,
             ],
             [
              'sign'   => 'popularize_url',
              'name'   => '推广分享地址',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'upload_url',
              'name'   => '下载地址域名',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'app_top_domain',
              'name'   => 'APP 大厅顶部域名配置',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'integral',
              'name'   => '输金额转换积分',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'max_register_give',
              'name'   => '注册送活动最高金额限制',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'max_sign_in_give',
              'name'   => '签到活动最高金额限制',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'max_first_recharge_give',
              'name'   => '首充送活动最高金额限制',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'max_red_envelopes_give',
              'name'   => '抢红包最高金额限制',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'max_guess_give',
              'name'   => '有奖竞猜最高金额限制',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'max_roulette_give',
              'name'   => '转盘活动最高金额限制',
              'value'  => null,
              'status' => 1,
             ],
             [
              'sign'   => 'withdraw_commission',
              'name'   => '出款手续费',
              'value'  => 2,
              'status' => 1,
             ],
             [
              'sign'   => 'withdraw_free_num',
              'name'   => '每天出款免手续费笔数',
              'value'  => 2,
              'status' => 1,
             ],
             [
              'sign'   => 'min_withdraw',
              'name'   => '每次出款最低金额',
              'value'  => 100,
              'status' => 1,
             ],
             [
              'sign'   => 'max_withdraw',
              'name'   => '每次出款最高金额',
              'value'  => 20000,
              'status' => 1,
             ],
             [
              'sign'   => 'day_withdraw',
              'name'   => '每日出款金额限制',
              'value'  => 100000,
              'status' => 1,
             ],
             [
              'sign'   => 'day_withdraw_num',
              'name'   => '每日出款次数',
              'value'  => 5,
              'status' => 1,
             ],
             [
              'sign'   => 'max_withdraw_commission',
              'name'   => '出款手续费最大金额',
              'value'  => 200,
              'status' => 1,
             ],
             [
              'sign'   => 'recharge_audit_times',
              'name'   => '入款稽核倍数',
              'value'  => 1,
              'status' => 1,
             ],
             [
              'sign'   => 'activity_audit_times',
              'name'   => '活动稽核倍数',
              'value'  => 2,
              'status' => 1,
             ],
             [
              'sign'   => 'audit_free',
              'name'   => '稽核不足出款手续费',
              'value'  => 0,
              'status' => 1,
             ],
             [
              'sign'   => 'audit_withdraw',
              'name'   => '稽核不足限制出款',
              'value'  => 1,
              'status' => 1,
             ],
             [
              'sign'   => 'max_artificial_recharge',
              'name'   => '人工充值最高金额限制',
              'value'  => 500,
              'status' => 1,
             ],
             [
              'sign'   => 'bank_card_frozen',
              'name'   => '新绑银行卡多少小时能出款',
              'value'  => 2,
              'status' => 1,
             ],
            ],
        );
    }
}
