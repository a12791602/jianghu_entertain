<?php

namespace App\Http\Requests\Backend\Merchant\GameVendor;

use App\Http\Requests\BaseFormRequest;

class StatusRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        return [
            'id' => 'required|exists:game_vendor_platforms,id',
            'status' => 'required|in:0,1',
            'type' => 'required|in:0,1',
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
            'status.required' => '请选择状态',
            'status.in' => '所选状态不存在',
            'type.required' => '请上传状态类型',
            'type.in' => '状态类型不在范围内'
        ];
    }
}
