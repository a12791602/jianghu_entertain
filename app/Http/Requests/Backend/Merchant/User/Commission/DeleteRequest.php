<?php

namespace App\Http\Requests\Backend\Merchant\User\Commission;

use App\Http\Requests\BaseFormRequest;

/**
 * 洗码设置-删除
 */
class DeleteRequest extends BaseFormRequest
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
        $rules = ['id' => 'required|integer|exists:users_commission_configs']; //ID
        return $rules;
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        $messages = [
                     'id.required' => '缺少洗码配置',
                     'id.exists'   => '该洗码配置不存在',
                    ];
        return $messages;
    }
}
