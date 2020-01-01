<?php

namespace App\Http\Requests\Backend\Merchant\System\BankCards;

use App\Http\Requests\BaseFormRequest;

/**
 * 银行卡反查-删除
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
        return [
            'id' => 'required|exists:frontend_users_bank_cards', //ID
        ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'id.required' => '缺少银行卡ID',
            'id.exists'   => '需要删除的银行卡不存在',
        ];
    }
}
