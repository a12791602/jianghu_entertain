<?php

namespace App\Http\Requests\Backend\Merchant\User\Commission;

use App\Http\Requests\BaseFormRequest;

/**
 * 洗码设置-编辑
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
                'id'      => 'required|integer|exists:users_commission_configs', //ID
                'bet'     => 'required|numeric|gte:0',                           //打码量
                'percent' => 'required|string',                                  //洗码比例
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'  => '缺少洗码配置',
                'id.exists'    => '该洗码配置不存在',
                'bet.required' => '缺少打码量',
                'bet.numeric'  => '打码量必须是数字',
                'bet.gte'      => '打码量必须大于等于0',
               ];
    }
}
