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
                                  'fund_password_old' => '当前安全码',
                                  'fund_password'     => '新安全码',
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
                'fund_password_old' => [
                                        'required',
                                        'regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',//(英文字母+数字 8到16位)
                                       ],
                'fund_password'     => [
                                        'required',
                                        'confirmed',
                                        'regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',//(英文字母+数字 8到16位)
                                       ],
                'verification_key'  => 'required|string',
                'verification_code' => 'required|string',
               ];
    }
}
