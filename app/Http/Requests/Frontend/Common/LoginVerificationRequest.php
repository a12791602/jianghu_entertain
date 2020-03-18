<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;

/**
 * Class VerificationCodeRequest
 * @package App\Http\Requests\Frontend\Common
 */
class LoginVerificationRequest extends BaseFormRequest
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
        $phone = 'regex:/^1[345789]\d{9}$/';//(手机号码第一位1第二位345789总共11位数字)
        return [
                'mobile'      => [
                                  'required',
                                  $phone,
                                  'exists:frontend_users,mobile',
                                 ],
                'password'    => 'required',
                'remember_me' => 'boolean',
               ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return mixed[]
     */
    public function messages(): array
    {
        return ['mobile.exists' => '手机号不存在'];
    }
}
