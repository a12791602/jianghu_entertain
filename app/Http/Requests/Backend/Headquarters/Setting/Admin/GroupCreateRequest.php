<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\Admin;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\BackendAdminAccessGroup;

/**
 *  Class for group create request.
 */
class GroupCreateRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [BackendAdminAccessGroup::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['role' => '权限'];

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
                'group_name' => 'required|unique:backend_admin_access_groups',
                'role'       => 'required|array',
                'role.*'     => 'integer',
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['role' => 'cast:array'];
    }
}
