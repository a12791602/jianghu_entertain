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
                'security_code'              => 'required|confirmed|digits:6',
                'security_code_confirmation' => 'required|digits:6',
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
                'security_code.required'  => '安全码不能为空',
                'security_code.confirmed' => '安全码两次输入不一致',
                'security_code.digits'    => '安全码必须由6位数字组成',
               ];
    }
}
