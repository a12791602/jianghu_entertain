<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;

/**
 * Class ResetSecurityPasswordRequest
 * @package App\Http\Requests\Frontend\Common
 */
class SecurityCodeRequest extends BaseFormRequest
{

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'security_code_old' => '当前安全码',
                                  'security_code'     => '新安全码',
                                  'verification_code' => '验证码',
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
                'security_code_old'          => 'required|digits:6',
                'security_code'              => 'required|confirmed|digits:6',
                'security_code_confirmation' => 'required|digits:6',
                'verification_key'           => 'required|string',
                'verification_code'          => 'required|string',
               ];
    }
}
