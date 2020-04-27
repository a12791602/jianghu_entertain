<?php

namespace App\Http\Requests\Backend\Merchant\Setting\Admin;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\MerchantAdminUser;

/**
 *  修改管理员密码
 */
class UpdatePasswordRequest extends BaseFormRequest
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
                'id'       => 'required|integer|exists:merchant_admin_users',
                'password' => 'required|string',
               ];
    }
}
