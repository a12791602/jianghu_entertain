<?php

namespace App\Http\Requests\Frontend\H5\Recharge;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceType;

/**
 * Class RechargeRequest
 * @package App\Http\Requests\Frontend\H5\Recharge
 */
class RechargeRequest extends BaseFormRequest
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
        $onLine   = 'system_finance_online_infos';
        $offLine  = 'system_finance_offline_infos';
        $isOnline = (int) $this->get('is_online');
        $table    = $isOnline === SystemFinanceType::IS_ONLINE_YES ? $onLine : $offLine;
        return [
                'is_online'  => 'required|in:0,1',
                'channel_id' => 'required|exists:' . $table . ',id',
                'money'      => 'required|integer|min:1',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'is_online.required'  => '请选择是否是线上金流',
                'is_online.in'        => '所选是否是线上金流参数不正确',
                'channel_id.required' => '请选择支付通道',
                'channel_id.exists'   => '所选支付通道不存在',
                'money.required'      => '请填写充值金额',
                'money.integer'       => '充值金额必须填写整数',
                'money.min'           => '充值金额不能低于1元',
               ];
    }
}
