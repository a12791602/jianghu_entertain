<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\Admin;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\BackendAdminUser;

/**
 *  删除总后台管理员用户
 */
class DeleteAdminRequest extends BaseFormRequest
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
                  'id'   => 'required|numeric|exists:backend_admin_users', //管理员ID
                  'name' => 'required|string|exists:backend_admin_users',  //管理员用户名
                 ];
        return $rules;
    }
}
