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
                'mobile'        => ['regex' => 'regex:/^1[345789]\d{9}$/'], //手机号码
                'guid'          => 'string', //用户UID
                'parent_mobile' => ['regex' => 'regex:/^1[345789]\d{9}$/'], //上级手机号码
                'is_online'     => 'integer|in:0,1', //0离线 1在线
                'last_login_ip' => 'ip', //最后登陆IP
                'register_ip'   => 'ip', //注册IP
                'create_at'     => 'string', //注册时间
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [];
    }
}
