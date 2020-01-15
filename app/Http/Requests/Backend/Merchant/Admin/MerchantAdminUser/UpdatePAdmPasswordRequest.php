<?php

namespace App\Http\Requests\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for create request.
 */
class UpdatePAdmPasswordRequest extends BaseFormRequest
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
        return [
                'name'     => 'required|unique:merchant_admin_users', //用户名
                'email'    => 'required|email|unique:merchant_admin_users', //邮箱
                'password' => 'required|string', //密码
                'is_test'  => 'required|integer', //0正常用户 1测试用户
                'group_id' => 'required|integer|exists:merchant_admin_access_groups,id', //管理组ID
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
