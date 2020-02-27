<?php

namespace App\Http\Requests\Backend\Headquarters\Admin\BackendAdminUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\BackendAdminUser;

/**
 * 更改管理员用户组
 */
class UpdateAdminGroupRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [BackendAdminUser::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['group_name' => '管理员组名称'];

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
}
