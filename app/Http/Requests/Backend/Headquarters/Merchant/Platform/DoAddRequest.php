<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for do add request.
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
     * Get the validation rules that apply to the request .
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
                'email'         => 'required|email|max:64|unique:merchant_admin_users', //超管邮箱
                'password'      => 'required|string',                                   //密码
                'platform_name' => 'required|unique:system_platforms,cn_name',          //平台名称
                'platform_sign' => 'required|unique:system_platforms,sign',             //平台标识
                'agency_method' => 'required|string',                                   //代理方式
                'domains'       => 'required|array',                                    //域名
                'domains.*'     => 'unique:system_domains,domain',                      //域名
                'role'          => 'required|string',                                   //权限
                'sms_num'       => 'required|integer|gte:0',                            //短信条数
                'status'        => 'required|integer|in:0,1',                           //开启状态
                'start_time'    => 'required|date_format:Y-m-d H:i:s',                  //开始时间
                'end_time'      => 'required|date_format:Y-m-d H:i:s',                  //结束时间
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'username.required'      => '缺少厅主名称',
                'username.string'        => '厅主名称必须是字符串',
                'username.max'           => '厅主名称不能超过32个字符',
                'email.required'         => '缺少厅主邮箱',
                'email.email'            => '厅主邮箱格式不正确',
                'email.max'              => '厅主邮箱不能超过64个字符',
                'email.unique'           => '厅主邮箱已存在',
                'password.required'      => '缺少厅主密码',
                'password.string'        => '厅主密码必须是字符串',
                'platform_name.required' => '缺少站点名称',
                'platform_name.unique'   => '站点名称已存在',
                'platform_sign.required' => '缺少站点标识',
                'platform_sign.unique'   => '站点标识已存在',
                'agency_method.required' => '缺少代理方式',
                'agency_method.string'   => '代理方式必须是字符串',
                'domains.required'       => '缺少域名',
                'domains.array'          => '域名数据必须是数组',
                'domains.*.unique'       => '域名已经存在',
                'role.required'          => '缺少菜单权限',
                'role.string'            => '菜单权限必须是字符串',
                'sms_num.required'       => '缺少短信数量',
                'sms_num.integer'        => '短信数量必须是正整数',
                'sms_num.gte'            => '短信数量必须是正整数',
                'status.required'        => '缺少厅主状态',
                'status.integer'         => '厅主状态必须是正整数',
                'status.in'              => '厅主状态数据不合法',
                'start_time.required'    => '缺少有效开始时间',
                'start_time.date_format' => '有效开始时间必须是Y-m-d H:i:s格式',
                'end_time.required'      => '缺少有效结束时间',
                'end_time.date_format'   => '有效结束时间必须是Y-m-d H:i:s格式',
               ];
    }
}
