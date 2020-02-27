<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Http\Requests\BaseFormRequest;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;

/**
 * 路由-是否开放
 */
class IsOpenRequest extends BaseFormRequest
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
        return [
                'id'      => 'required|exists:system_routes_backends', //路由ID
                'is_open' => 'required|in:0,1',                   //是否开放  0否 1是
               ];
    }
}
