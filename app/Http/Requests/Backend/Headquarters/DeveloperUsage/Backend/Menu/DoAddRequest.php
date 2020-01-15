<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for menu do add request.
 */
class DoAddRequest extends BaseFormRequest
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
                  'label'     => 'required|unique:backend_system_menus|regex:/[\x{4e00}-\x{9fa5}]+/u', //操作日志
                  'en_name'   => [
                                  'required',
                                  'unique:backend_system_menus',
                                  'regex:/^(?!\.)(?!.*\.$)(?!.*?\.\.)[a-z.-]+$/',
                                 ], //operation.log
                  'display'   => 'required|numeric|in:0,1',
                  'route'     => 'required|regex:/^(?!.*\/$)(?!.*?\/\/)[a-z\/-]+$/', // /operasyon/operation-log
                  'icon'      => 'regex:/^(?!\-)(?!.*\-$)(?!.*?\-\-)(?!\ )(?!.*\ $)(?!.*?\ \ )[a-z0-9 -]+$/',
                  'sort'      => 'required|integer',
                  'is_parent' => 'numeric|in:0,1',
                  'parent_id' => 'numeric|required_unless:is_parent,1',
                  'level'     => 'numeric|in:1,2,3|required_unless:is_parent,1',
                  //anticon anticon-appstore  icon-6-icon
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
