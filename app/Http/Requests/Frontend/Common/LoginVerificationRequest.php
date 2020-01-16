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
        $phone = 'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/';
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
