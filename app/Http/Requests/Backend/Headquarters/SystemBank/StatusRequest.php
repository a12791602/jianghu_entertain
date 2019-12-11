<?php

namespace App\Http\Requests\Backend\Headquarters\SystemBank;

use App\Http\Requests\BaseFormRequest;

/**
 * Class StatusRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\SystemBank
 */
class StatusRequest extends BaseFormRequest
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
    public function rules() :array
    {
        return [
            'id' => 'required|exists:system_banks,id',
            'status' => 'required|in:0,1',
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
        ];
    }
}
