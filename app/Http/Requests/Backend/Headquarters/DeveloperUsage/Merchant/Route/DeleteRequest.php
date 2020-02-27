<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Http\Requests\BaseFormRequest;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;

/**
 * 路由-删除
 */
class DeleteRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemRoutesMerchant::class];
    
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
        $rules = ['id' => 'required|exists:system_routes_merchants'];  //ID
        return $rules;
    }
}
