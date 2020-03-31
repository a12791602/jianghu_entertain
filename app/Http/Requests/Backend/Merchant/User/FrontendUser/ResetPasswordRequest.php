<?php

namespace App\Http\Requests\Backend\Merchant\User\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUser;

/**
 * 会员重置密码
 */
class ResetPasswordRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [FrontendUser::class];

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
                'guid'     => 'required|string|exists:frontend_users,guid',
                'password' => 'required|confirmed|regex:/^[0-9a-zA-Z]{8,16}$/',//(大小写字母加数字 8,16位)
               ];
    }
}
