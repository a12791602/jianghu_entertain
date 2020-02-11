<?php

namespace App\Http\Requests\Backend\Merchant\User\FrontendUser;

use App\Http\Requests\BaseFormRequest;

/**
 * 用户列表
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
                'mobile'        => ['regex' => 'regex:/^1[345789]\d{9}$/'], //手机号码
                'guid'          => 'string', //用户UID
                'parent_mobile' => ['regex' => 'regex:/^1[345789]\d{9}$/'], //上级手机号码
                'isOnline'      => 'integer|in:0,1', //0离线 1在线
                'lastLoginIp'   => 'ip', //最后登陆IP
                'registerIp'    => 'ip', //注册IP
                'createAt'      => 'string', //注册时间
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
