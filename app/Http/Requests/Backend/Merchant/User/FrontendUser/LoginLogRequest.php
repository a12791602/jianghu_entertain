<?php

namespace App\Http\Requests\Backend\Merchant\User\FrontendUser;

use App\Http\Requests\BaseFormRequest;

/**
 * 用户登陆几率
 */
class LoginLogRequest extends BaseFormRequest
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
            'mobile'      => ['regex' => 'regex:/^1[345789]\d{9}$/'], //手机号码
            'uniqueId'    => 'string', //用户UID
            'createAt'    => 'string', //登陆时间
            'lastLoginIp' => 'ip', //登陆IP
        ];
    }

    // /**
    //  * @return mixed[]
    //  */
    // public function messages(): array
    // {
    //     return [

    //     ];
    // }
}
