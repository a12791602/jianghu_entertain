<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

/**
 * Class for menu edit request.
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
                  'id'      => 'required|numeric|exists:backend_system_menus,id',//ID
                  'label'   => [
                                'required',
                                Rule::unique('backend_system_menus')->ignore($this->get('menu_id')),
                                'regex:/[\x{4e00}-\x{9fa5}]+/u',
                               ], //菜单名称
                  'en_name' => [
                                'required',
                                Rule::unique('backend_system_menus')->ignore($this->get('menu_id')),
                                'regex:/^(?!\.)(?!.*\.$)(?!.*?\.\.)[a-z.-]+$/',
                               ], //英文名
                  'display' => 'required|numeric|in:0,1',//是否显示  0否 1是
                  'route'   => 'required|regex:/^(?!.*\/$)(?!.*?\/\/)[a-z\/-]+$/', //路由
                  'icon'    => 'required|regex:/^(?!\-)(?!.*\-$)(?!.*?\-\-)(?!\ )(?!.*\ $)(?!.*?\ \ )[a-z0-9 -]+$/',//图标
                  'pid'     => 'required|integer', //上级id
                 ];
        return $rules;
    }

    /*public function messages()
    {
    return [
    'lottery_sign.required' => 'lottery_sign is required!',
    'trace_issues.required' => 'trace_issues is required!',
    'balls.required' => 'balls is required!'
    ];
    }*/
}
