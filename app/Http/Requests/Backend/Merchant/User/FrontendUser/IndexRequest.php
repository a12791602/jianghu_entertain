<?php

namespace App\Http\Requests\Backend\Merchant\User\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUser;

/**
 * 用户列表
 */
class IndexRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [FrontendUser::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'parent_mobile' => '上级帐号',
                                  'role'          => '权限',
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
                'mobile'        => ['regex' => 'regex:/^1[345789]\d{9}$/'], //手机号码(第一位1第二位345789总共11位数字)
                'guid'          => 'string|max:16',                                //用户UID
                'parent_mobile' => ['regex' => 'regex:/^1[345789]\d{9}$/'], //上级手机号码(第一位1第二位345789总共11位数字)
                'is_online'     => 'integer|in:0,1',                        //0离线 1在线
                'is_tester'     => 'integer|in:0,1',                        //0正式帐号 1测试账号
                'last_login_ip' => 'ip',                                    //最后登陆IP
                'register_ip'   => 'ip',                                    //注册IP
                'created_at'    => 'array|size:2',                          //注册时间
                'created_at.*'  => 'date',                                  //注册时间
                'pageSize'      => 'integer|between:1,100',                 //每页数据条数
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
