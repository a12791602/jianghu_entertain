<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\Admin;

use App\Http\Requests\BaseFormRequest;

/**
 * 搜索管理员用户
 */
class SearchAdminRequest extends BaseFormRequest
{
    
    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['searchStr' => '搜索条件'];

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
        return ['searchStr' => 'string'];
    }
}
