<?php

namespace App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\BackendAdminUser;

/**
 *  生成总后台管理员用户
 */
class CreateRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [BackendAdminUser::class];
    
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
                  'name'     => 'required|unique:backend_admin_users', //用户名
                  'email'    => 'required|email|unique:backend_admin_users', //邮箱
                  'password' => 'required|string', //密码
                  'group_id' => 'required|numeric|exists:backend_admin_access_groups,id', //管理员组ID
                 ];
        return $rules;
    }
}
