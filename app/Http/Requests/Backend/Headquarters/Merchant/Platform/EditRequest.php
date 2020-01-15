<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for do edit request.
 */
class EditRequest extends BaseFormRequest
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
                'id'            => 'required|exists:system_platforms', //ID
                'agency_method' => 'required|string',                  //代理方式
                'role'          => 'required|string',                  //权限
                'type'          => 'in:0,1',                           //短信操作方式  0减少  1增加
                'sms_num'       => 'integer|gte:0',                    //操作短信数量
                'start_time'    => 'required|date_format:Y-m-d H:i:s', //开始时间
                'end_time'      => 'required|date_format:Y-m-d H:i:s', //结束时间
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'            => '缺少站点ID',
                'id.exists'              => '站点不存在',
                'agency_method.required' => '缺少代理方式',
                'agency_method.string'   => '代理方式必须是字符串',
                'role.required'          => '缺少菜单权限',
                'role.string'            => '菜单权限必须是字符串',
                'type.in'                => '短信操作方式数据非法',
                'sms_num.integer'        => '短信操作数量必须是正整数',
                'sms_num.gte'            => '短信操作数量必须是正整数',
                'start_time.required'    => '缺少有效开始时间',
                'start_time.date_format' => '有效开始时间必须是Y-m-d H:i:s格式',
                'end_time.required'      => '缺少有效结束时间',
                'end_time.date_format'   => '有效结束时间必须是Y-m-d H:i:s格式',
               ];
    }
}
