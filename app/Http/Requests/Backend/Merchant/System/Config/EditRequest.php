<?php

namespace App\Http\Requests\Backend\Merchant\System\Config;

use App\Http\Requests\BaseFormRequest;

/**
 * 全域设置-编辑
 */
class EditRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
                'param'                                  => 'array',
                'param.0.login_error_num.value'          => 'integer',     //登录密码错误限制次数
                'param.0.register_invite_code.value'     => 'string',      //注册邀请码
                'param.0.system_maintenance.value'       => 'integer:0,1', //系统维护总开关 0关闭  1开启
                'param.0.commission.value'               => 'integer:0,1', //是否开启洗码 0关闭  1开启
                'param.0.chat_user_grade.value'          => 'integer',     //聊天室用户等级
                'param.0.play_min_recharge.value'        => 'numeric',     //最低充值多少才能游戏
                'param.0.withdraw_error_num.value'       => 'integer',     //取款密码错误次数限制
                'param.0.popularize_url.value'           => 'string',      //推广分享地址
                'param.0.upload_url.value'               => 'string',      //下载地址域名
                'param.0.app_top_domain.value'           => 'string',      //APP 大厅顶部域名配置
                'param.0.integral.value'                 => 'numeric',     //输金额转换积分
                'param.0.max_register_give.value'        => 'numeric',     //注册送活动最高金额限制
                'param.0.max_register_give.status'       => 'integer:0,1', //注册送活动最高金额限制 状态：0关闭 1开启
                'param.0.max_sign_in_give.value'         => 'numeric',     //签到活动最高金额限制
                'param.0.max_sign_in_give.status'        => 'integer:0,1', //签到活动最高金额限制 状态：0关闭 1开启
                'param.0.max_first_recharge_give.value'  => 'numeric',     //首充送活动最高金额限制
                'param.0.max_first_recharge_give.status' => 'integer:0,1', //首充送活动最高金额限制 状态：0关闭 1开启
                'param.0.max_red_envelopes_give.value'   => 'numeric',     //抢红包最高金额限制
                'param.0.max_red_envelopes_give.status'  => 'integer:0,1', //抢红包最高金额限制 状态：0关闭 1开启
                'param.0.max_guess_give.value'           => 'numeric',     //有奖竞猜最高金额限制
                'param.0.max_guess_give.status'          => 'integer:0,1', //有奖竞猜最高金额限制 状态：0关闭 1开启
                'param.0.max_roulette_give.value'        => 'numeric',     //转盘活动最高金额限制
                'param.0.max_roulette_give.status'       => 'integer:0,1', //转盘活动最高金额限制 状态：0关闭 1开启
                'param.0.withdraw_commission.value'      => 'numeric',     //出款手续费
                'param.0.withdraw_free_num.value'        => 'integer',     //每天出款免手续费笔数
                'param.0.min_withdraw.value'             => 'numeric',     //每次出款最低金额
                'param.0.max_withdraw.value'             => 'numeric',     //每次出款最高金额
                'param.0.day_withdraw.value'             => 'numeric',     //每日出款金额限制
                'param.0.day_withdraw_num.value'         => 'integer',     //每日出款次数
                'param.0.max_withdraw_commission.value'  => 'numeric',     //出款手续费最大金额
                'param.0.recharge_audit_times.value'     => 'numeric',     //入款稽核倍数
                'param.0.activity_audit_times.value'     => 'numeric',     //活动稽核倍数
                'param.0.audit_free.value'               => 'numeric',     //稽核不足出款手续费
                'param.0.audit_withdraw.value'           => 'integer:0,1', //稽核不足限制出款  0关闭  1开启
                'param.0.max_artificial_recharge.value'  => 'numeric',     //人工充值最高金额限制
                'param.0.bank_card_frozen.value'         => 'integer',     //新绑银行卡多少小时能出款
               ];
    }

    /**
     * @return mixed[]
     */
    // public function messages(): array
    // {
    //     return [

    //            ];
    // }
    
    /**
     *  Filters to be applied to the input.
     *
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['param' => 'cast:array'];
    }
}
