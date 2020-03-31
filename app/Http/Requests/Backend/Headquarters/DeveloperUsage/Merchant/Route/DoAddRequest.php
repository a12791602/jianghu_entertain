<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Http\Requests\BaseFormRequest;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;

/**
 * 路由-添加
 */
class DoAddRequest extends BaseFormRequest
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
                'menu_group_id' => 'required|exists:merchant_system_menus,id',               //菜单ID
                'title'         => 'required|string|max:32',                                 //标题
                'route_name'    => 'required|string|max:128|unique:system_routes_merchants', //路由名称
                'controller'    => 'required|string|max:128',                                //控制器
                'method'        => 'required|string|max:32',                                 //方法
               ];
    }
}
