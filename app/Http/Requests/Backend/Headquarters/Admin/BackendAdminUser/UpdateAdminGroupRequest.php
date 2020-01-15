<?php

namespace App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\Requests\BaseFormRequest;

/**
 * 更改管理员用户组
 */
class UpdateAdminGroupRequest extends BaseFormRequest
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
                  'id'         => 'required|numeric|exists:backend_admin_users,id',         //管理员ID
                  'group_id'   => 'required|numeric|exists:backend_admin_access_groups,id', //管理组ID
                  'group_name' => 'required|string|exists:backend_admin_access_groups',     //管理组名称
                 ];
        return $rules;
    }

    // public function messages()
    // {
    // return [
    // 'lottery_sign.required' => 'lottery_sign is required!',
    // 'trace_issues.required' => 'trace_issues is required!',
    // 'balls.required' => 'balls is required!'
    // ];
    // }
}
