<?php

namespace App\Http\Requests\Backend\Merchant\User\UserBlackList;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUsersBlackList;

/**
 * 解除黑名单
 */
class RemoveRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [FrontendUsersBlackList::class];

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
        $rules = ['id' => 'required|integer|exists:frontend_users_black_lists'];//ID
        return $rules;
    }
}
