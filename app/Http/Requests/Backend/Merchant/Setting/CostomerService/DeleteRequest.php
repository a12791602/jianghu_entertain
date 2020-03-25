<?php

namespace App\Http\Requests\Backend\Merchant\Setting\CostomerService;

use App\Http\Requests\BaseFormRequest;

/**
 * 客服设置-删除
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
        $rules = ['id' => 'required|integer|exists:system_costomer_services']; //ID
        return $rules;
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        $messages = [
                     'id.required' => '缺少客服ID',
                     'id.exists'   => '需要删除的客服不存在',
                    ];
        return $messages;
    }
}
