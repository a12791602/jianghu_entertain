<?php

namespace App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\Requests\BaseFormRequest;

/**
 * 修改管理员状态
 */
class SwitchAdminRequest extends BaseFormRequest
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
                  'id'     => 'required|exists:backend_admin_users', //ID
                  'status' => 'required|integer|in:0,1',             //状态
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
