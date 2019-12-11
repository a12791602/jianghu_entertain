<?php

namespace App\Http\Requests\Backend\Headquarters\FinanceChannel;

use App\Http\Requests\BaseFormRequest;

/**
 * Class OptEditDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\FinanceChannel
 */
class OptEditDoRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'id' => 'required|exists:system_finance_channels,id',
            'name' => 'required|unique:system_finance_channels,name,'.$this->get('id'),
            'desc' => 'string',
        ];
    }

    /**
     * @return array
     */
    public function messages() :array
    {
        return [
            'id.required' => 'ID不存在',
            'id.exists' => 'ID不存在',
            'name.required' => '请填写通道名称',
            'name.unique' => '通道名称已存在',
            'desc.string' => '备注格式不正确',
        ];
    }
}
