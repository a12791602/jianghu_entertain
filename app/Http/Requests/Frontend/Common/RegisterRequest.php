<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;

/**
 * Class RegisterRequest
 * @package App\Http\Requests\Frontend\Common
 */
class RegisterRequest extends BaseFormRequest
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
                'invite_code'           => 'integer',
                'password'              => [
                                            'required',
                                            'confirmed',
                                            //(必须存在大小写字母+数字的8-16位)
                                            'regex:/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',
                                           ],
                'password_confirmation' => 'required',
                'verification_key'      => 'required|string',
                'verification_code'     => 'required|string',
               ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return mixed[]
     */
    public function messages(): array
    {
        return ['password.regex' => '密码仅允许8-16位数字或大小写字母组成'];
    }
}
