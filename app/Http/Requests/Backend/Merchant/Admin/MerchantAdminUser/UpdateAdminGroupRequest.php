<?php

namespace App\Http\Requests\Backend\Merchant\Admin\MerchantAdminUser;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for update admin group request.
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
        return [
                'id'       => 'required|integer|exists:merchant_admin_users,id',
                'group_id' => 'required|integer|exists:merchant_admin_access_groups,id',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'       => '缺少管理员ID',
                'id.integer'        => '管理员ID只能是整数',
                'id.exists'         => '管理员不存在',
                'group_id.required' => '缺少角色组ID',
                'group_id.integer'  => '角色组ID只能是整数',
                'group_id.exists'   => '角色组不存在',
               ];
    }
}
