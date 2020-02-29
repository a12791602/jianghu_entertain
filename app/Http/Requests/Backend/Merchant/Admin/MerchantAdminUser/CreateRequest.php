<?php

namespace App\Http\Requests\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\MerchantAdminUser;

/**
 * Class for create request.
 */
class CreateRequest extends BaseFormRequest
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
                'name'     => 'required|unique:merchant_admin_users',
                'email'    => 'required|email|unique:merchant_admin_users',
                'password' => 'required|string',
                'group_id' => 'required|integer|exists:merchant_admin_access_groups,id',
               ];
    }
}
