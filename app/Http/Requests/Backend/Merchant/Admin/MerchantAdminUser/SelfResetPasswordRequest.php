<?php

namespace App\Http\Requests\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\MerchantAdminUser;

/**
 * 管理员自己修改密码
 */
class SelfResetPasswordRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [MerchantAdminUser::class];

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
                'name'     => 'required|unique:merchant_admin_users', //用户名
                'email'    => 'required|email|unique:merchant_admin_users', //邮箱
                'password' => 'required|string', //密码
                'group_id' => 'required|integer|exists:merchant_admin_access_groups,id', //管理组ID
               ];
    }
}
