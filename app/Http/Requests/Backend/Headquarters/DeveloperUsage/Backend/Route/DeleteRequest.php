<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Backend\Route;

use App\Http\Requests\BaseFormRequest;
use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;

/**
 *  路由-删除
 */
class DeleteRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemRoutesBackend::class];
    
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
        $rules = ['id' => 'required|exists:system_routes_backends'];//ID
        return $rules;
    }
}
