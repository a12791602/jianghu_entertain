<?php

namespace App\Http\Requests\Backend\Merchant\System\HelpCenter;

use App\Http\Requests\BaseFormRequest;

/**
 * 帮助设置-删除
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
        $rules = ['id' => 'required|exists:system_users_help_centers']; //ID
        return $rules;
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        $messages = [
                     'id.required' => '缺少客帮助设置ID',
                     'id.exists'   => '需要删除的帮助设置不存在',
                    ];
        return $messages;
    }
}
