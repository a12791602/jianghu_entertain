<?php

namespace App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\Requests\BaseFormRequest;

/**
 * 删除总后台管理员用户
 */
class DeleteAdminRequest extends BaseFormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|numeric|exists:backend_admin_users', //管理员ID
            'name' => 'required|string|exists:backend_admin_users', //管理员用户名
        ];
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
