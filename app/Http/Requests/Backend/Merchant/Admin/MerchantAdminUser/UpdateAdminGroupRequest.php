<?php

namespace App\Http\Requests\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\MerchantAdminUser;

/**
 * Class for update admin group request.
 */
class UpdateAdminGroupRequest extends BaseFormRequest
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
                'id'       => 'required|integer|exists:merchant_admin_users,id',
                'group_id' => 'required|integer|exists:merchant_admin_access_groups,id',
               ];
    }
}
