<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Http\Requests\BaseFormRequest;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;

/**
 * Class for menu delete request.
 */
class ChangeParentRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [MerchantSystemMenu::class];

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
                'id'    => 'required|integer|exists:merchant_system_menus',//ID
                'pid'   => 'required|integer',                             //上级ID
                'sort'  => 'required|integer|gte:0',                       //排序
                'level' => 'required|integer|gte:0',                       //层级
               ];
    }
}
