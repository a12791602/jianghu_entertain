<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Http\Requests\BaseFormRequest;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Validation\Rule;

/**
 *  Class for menu edit request.
 */
class EditRequest extends BaseFormRequest
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
                'id'      => 'required|numeric|exists:merchant_system_menus,id',//ID
                'label'   => [
                              'required',
                              Rule::unique('merchant_system_menus')->ignore($this->get('id')),
                              'regex:/[\x{4e00}-\x{9fa5}]+/u',
                             ], //菜单名称(中文)
                'en_name' => [
                              'required',
                              Rule::unique('merchant_system_menus')->ignore($this->get('id')),
                              'regex:/^[A-Za-z]{3,30}+$/',
                             ], //3-30位大小写
                'display' => 'required|numeric|in:0,1',//是否显示 0否 1是
                'route'   => 'required|regex:/^(?!.*\/$)(?!.*?\/\/)[a-z\/-]+$/', //路由(小写+数字+“/”)
                  //图标(小写+数字+“-”)
                'icon'    => 'required|regex:/^(?!\-)(?!.*\-$)(?!.*?\-\-)(?!\ )(?!.*\ $)(?!.*?\ \ )[a-z0-9 -]+$/',
                'pid'     => 'required|integer',//上级ID
               ];
    }
}
