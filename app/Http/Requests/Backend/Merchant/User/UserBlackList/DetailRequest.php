<?php

namespace App\Http\Requests\Backend\Merchant\User\UserBlackList;

use App\Http\Requests\BaseFormRequest;

/**
 * 黑名单详情
 */
class DetailRequest extends BaseFormRequest
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
            'uniqueId' => 'required|exists:frontend_users_black_lists,uid', //用户UID
            'createAt' => 'string', //进入黑名单日期
            'status' => 'integer|in:0,1', //状态  0拉黑 1解封
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
