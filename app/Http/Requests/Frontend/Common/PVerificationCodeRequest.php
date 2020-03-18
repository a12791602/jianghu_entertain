<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;

/**
 * Class PasswordVerificationCodeRequest
 * @package App\Http\Requests\Frontend\Common
 */
class PVerificationCodeRequest extends BaseFormRequest
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
                'mobile' => [
                             'required',
                             'regex:/^1[345789]\d{9}$/',//(手机号码第一位1第二位345789总共11位数字)
                            ],
               ];
    }
}
