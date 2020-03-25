<?php

namespace App\Http\Requests\Backend\Merchant\Setting\CostomerService;

use App\Http\Requests\BaseFormRequest;

/**
 * 客服设置-添加
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
                'name'    => 'required_if:type,1|string|max:12',                   //客服名称
                'link'    => 'required|string|max:255',                            //聊天链接
                'number'  => 'required_if:type,1|integer|digits_between:min:6,16', //号码
                'content' => 'required_if:type,2|string|max:64',                   //内容
                'type'    => 'required|integer|in:1,2',                            //1.qq微信    2.在线
                'version' => 'required|integer|in:1,2,3,4',                        //1.qq   2.微信  3.专业版  4.企业版
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'name.required_if'      => '缺少客服名称',
                'name.string'           => '名称必须是字符串',
                'name.max'              => '名称最多12个字符',
                'link.required'         => '缺少聊天链接',
                'link.string'           => '聊天链接必须是字符串',
                'link.max'              => '聊天链接最多255个字符',
                'number.required_if'    => '缺少客服号码',
                'number.integer'        => '客服号码必须是数字',
                'number.digits_between' => '客服号码只能是6-16位数字',
                'content.required_if'   => '缺少内容',
                'content.string'        => '内容必须是字符串',
                'content.max'           => '内容最多64个字符',
                'type.required'         => '缺少客服类型',
                'type.integer'          => '客服类型数据只能是数字',
                'type.in'               => '客服类型数据非法',
                'version.required'      => '缺少客服版本',
                'version.integer'       => '客服版本数据只能是数字',
                'version.in'            => '客服版本数据非法',
               ];
    }
}
