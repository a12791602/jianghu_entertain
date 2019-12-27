<?php

namespace App\Http\Requests\Backend\Merchant\System\HelpCenter;

use App\Http\Requests\BaseFormRequest;

/**
 * 帮助设置-添加
 */
class DoAddRequest extends BaseFormRequest
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
            'title'  => 'required|string|max:32',    //标题
            'pic'    => 'required|string|max:128',   //图片路径
            'type'   => 'required|integer|in:1,2,3', //客户端   1. H5  2. PC  3. APP
            'status' => 'required|integer|in:0,1',   //开启状态 0.关闭 1.开启
        ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'title.required_if' => '缺少标题',
            'title.string'      => '标题必须是字符串',
            'title.max'         => '标题最多32个字符',
            'pic.required'      => '缺少图片路径',
            'pic.string'        => '图片路径必须是字符串',
            'pic.max'           => '图片路径最多128个字符',
            'type.required'     => '缺少客户端类型',
            'type.integer'      => '客户端类型数据只能是数字',
            'type.in'           => '客户端类型数据非法',
            'status.required'   => '缺少状态',
            'status.integer'    => '状态只能是数字',
            'status.in'         => '状态数据非法',
        ];
    }
}
