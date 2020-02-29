<?php

namespace App\Http\Requests\Backend\Merchant\Admin\MerchantAdminGroup;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\MerchantAdminAccessGroup;

/**
 * Class for destroy request.
 */
class DestroyRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [MerchantAdminAccessGroup::class];
    
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
                'id'         => 'required|numeric|exists:merchant_admin_access_groups',
                'group_name' => 'required|exists:merchant_admin_access_groups',
               ];
    }
}
