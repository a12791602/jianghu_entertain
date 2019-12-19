<?php

namespace App\Http\Requests\Backend\Merchant\User\UserBlackList;

use App\Http\Requests\BaseFormRequest;

/**
 * 解除黑名单
 */
class RemoveRequest extends BaseFormRequest
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
            'id' => 'required|exists:frontend_users_black_lists', //ID
        ];
    }

    // /**
    //  * @return mixed[]
    //  */
    // public function messages(): array
    // {
    //     return [

    //     ];
    // }
}
