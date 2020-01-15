<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\SmsConfig;

use App\Http\Requests\BaseFormRequest;

/**
 * 短信配置-禁用启用
 */
class StatusRequest extends BaseFormRequest
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
                'id'     => 'required|exists:system_sms_configs', //ID
                'status' => 'required|integer|in:0,1',            //状态 0禁用 1启用
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'     => '缺少短信配置ID',
                'id.exists'       => '该短信配置不存在',
                'status.required' => '缺少短信配置状态',
                'status.integer'  => '短信配置状态必须是整数',
                'status.in'       => '短信配置状态数据非法',
               ];
    }
}
