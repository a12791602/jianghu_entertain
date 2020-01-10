<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\SmsConfig;

use App\Http\Requests\BaseFormRequest;

/**
 * 短信配置-列表
 */
class IndexRequest extends BaseFormRequest
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
            'name'      => 'string', //最后更新人名称
            'updatedAt' => 'string', //更新时间
            'status'    => 'in:0,1', //状态 0禁用 1启用
        ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'editorId.integer' => '更新人ID必须是整数',
            'updatedAt.string' => '更新时间区间必须是字符串',
            'status.in'        => '启用状态数据非法',
        ];
    }
}
