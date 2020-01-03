<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

/**
 * 路由-编辑
 */
class EditRequest extends BaseFormRequest
{
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
        $rules = [
            'id'            => 'required|exists:system_routes_merchants',   //ID
            'menu_group_id' => 'required|exists:merchant_system_menus,id', //菜单ID
            'title'         => 'required|string|max:10',                   //标题
            'route_name'    => [
                'required',
                'string',
                'max:128',
                Rule::unique('system_routes_merchants')->ignore($this->get('id')),
            ],                                           //路由名称
            'controller'    => 'required|string|max:32', //控制器
            'method'        => 'required|string|max:32',
        ];
        return $rules;
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        $messages = [
            'id.required'            => '缺少路由ID',
            'id.exists'              => '当前路由不存在',
            'menu_group_id.required' => '缺少绑定的菜单ID',
            'menu_group_id.exists'   => '绑定的菜单ID不存在',
            'title.required'         => '缺少标题',
            'title.string'           => '标题只能是字符串',
            'title.max'              => '标题最多10个字符',
            'route_name.required'    => '缺少路由名称',
            'route_name.string'      => '路由名称只能是字符串',
            'route_name.max'         => '路由名称最多128个字符',
            'route_name.unique'      => '路由名称已存在',
            'controller.required'    => '缺少控制器名称',
            'controller.string'      => '控制器名称只能是字符串',
            'controller.max'         => '控制器名称最多32个字符',
            'method.required'        => '缺少方法名称',
            'method.string'          => '方法名称只能是字符串',
            'method.max'             => '方法名称最多32个字符',
        ];
        return $messages;
    }
}
