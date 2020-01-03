<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;

/**
 * Class SecurityVerificationCodeRequest
 * @package App\Http\Requests\Frontend\Common
 */
class SecurityVerificationCodeRequest extends BaseFormRequest
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
            'security_code' => 'required|alpha_num|confirmed|between:6,12',
            'security_code_confirmation' => 'required|alpha_num|between:6,12',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'security_code.required' => '安全码不能为空',
            'security_code.between' => '安全码只能由6-12位字母和数字组成',
            'security_code.alpha_num' => '安全码只能由字母和数字组成',
        ];
    }
}
