<?php

namespace App\Http\Requests\Backend\Headquarters\FinanceChannel;

use App\Http\Requests\BaseFormRequest;

/**
 * Class EditDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\FinanceChannel
 */
class EditDoRequest extends BaseFormRequest
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
        $thisId = $this->input('id');
        return [
                'id'           => 'required|exists:system_finance_channels,id',
                'type_id'      => 'required|exists:system_finance_types,id',
                'vendor_id'    => 'required|exists:system_finance_vendors,id',
                'name'         => 'required|unique:system_finance_channels,name,' . $thisId,
                'sign'         => 'required|unique:system_finance_channels,sign,' . $thisId . '|regex:/\w+/',
                'request_mode' => 'required|in:0,1',
                'request_url'  => 'required|url',
                'banks_code'   => 'string',
                'status'       => 'required|in:0,1',
                'desc'         => 'string',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'           => 'ID不存在',
                'id.exists'             => 'ID不存在',
                'type_id.required'      => '请选择金流分类',
                'type_id.exists'        => '金流分类不存在',
                'vendor_id.required'    => '请选择金流厂商',
                'vendor_id.exists'      => '金流厂商不存在',
                'name.required'         => '请填写通道名称',
                'name.unique'           => '通道名称已存在',
                'sign.required'         => '请填写通道标记',
                'sign.unique'           => '通道标记已存在',
                'sign.regex'            => '通道标记只能包含数字,字母,下划线',
                'request_mode.required' => '请选择请求模式',
                'request_mode.in'       => '请求模式不存在',
                'request_url.required'  => '请填写请求地址',
                'request_url.url'       => '请求地址不正确',
                'banks_code.string'     => '银行码格式不正确',
                'status.required'       => '请选择状态',
                'status.in'             => '状态不存在',
                'desc.string'           => '备注格式不正确',
               ];
    }
}
