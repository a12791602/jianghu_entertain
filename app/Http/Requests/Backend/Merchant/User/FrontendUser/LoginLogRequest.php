<?php

namespace App\Http\Requests\Backend\Merchant\User\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\Systems\SystemLogsFrontend;

/**
 * 用户登陆记录
 */
class LoginLogRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemLogsFrontend::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'guid'    => '会员id',
                                  'data_ip' => '登录IP',
                                 ];

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
                'mobile'       => ['regex' => 'regex:/^1[345789]\d{9}$/'], //(手机号码第一位1第二位345789总共11位数字)
                'guid'         => 'string|max:16',                         //用户UID
                'data_ip'      => 'ip',                                    //登陆IP
                'created_at'   => 'array|size:2',                          //登陆日期
                'created_at.*' => 'date|date_format:Y-m-d',                //登陆日期
                'pageSize'     => 'integer|between:1,100',                 //每页数据条数
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['created_at' => 'cast:array'];
    }
}
