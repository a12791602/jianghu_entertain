<?php

namespace App\Http\Requests\Backend\Merchant\Finance\Online;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceOnlineInfo;
use App\Rules\CustomUnique;

/**
 * Class EditRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\Online
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
        if ($this->isMethod('post')) {
            $myId   = $this->get('id');
            $unique = new CustomUnique($this, 'system_finance_online_infos', 'platform_sign', $myId);
            return [
                'id' => 'required|exists:system_finance_online_infos,id',
                'channel_id' => 'required|exists:system_finance_channels,id',
                'frontend_name' => ['required', $unique],
                'merchant_code' => 'required',
                'merchant_no' => 'string',
                'encrypt_mode' => 'required|in:'
                    . SystemFinanceOnlineInfo::ENCRYPT_MODE_SECRET
                    . ',' . SystemFinanceOnlineInfo::ENCRYPT_MODE_CERT,
                'merchant_secret' => 'string',
                'public_key' => 'string',
                'private_key' => 'string',
                'request_url' => 'required|url',
                'vendor_url' => 'url',
                'app_id' => 'string',
                'tags' => 'array',
                'tags.*' => 'exists:users_tags,id',
                'min' => 'required|integer',
                'max' => 'required|integer|gt:min',
                'handle_fee' => 'integer',
                'desc' => 'string',
                'backend_remark' => 'string',
            ];
        }
        return [
            'id' => 'required|exists:system_finance_online_infos,id',
        ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'id.required' => 'ID不存在',
            'id.exists' => 'ID不存在',
            'channel_id.required' => '请选择支付渠道',
            'channel_id.exists' => '所选渠道不存在',
            'frontend_name.required' => '请填写前台名称',
            'frontend_name.unique' => '前台名称已存在',
            'merchant_code.required' => '请填写商户号',
            'encrypt_mode.required' => '请选择加密方式',
            'encrypt_mode.in' => '所选加密方式不存在',
            'request_url.required' => '请填写请求地址',
            'request_url.url' => '请求地址不符合规则',
            'tags.array' => '标签不符合规则',
            'tags.*' => '所选标签不存在',
            'min.required' => '请填写最低充值金额',
            'min.integer' => '最低充值金额类型不正确',
            'max.required' => '请填写最大充值金额',
            'max.integer' => '最大充值金额类型不正确',
            'max.gt' => '最大充值金额必须大于最小充值金额',
            'handle_fee.integer' => '手续费类型不正确',
        ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return [
            'tags' => 'cast:array',
        ];
    }
}
