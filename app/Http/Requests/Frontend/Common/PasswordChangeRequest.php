<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;
use App\Rules\Frontend\SecurityCodeCheckRule;

/**
 * Class PasswordChangeRequest
 * @package App\Http\Requests\Frontend\Common
 */
class PasswordChangeRequest extends BaseFormRequest
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
        $result = [
                   'security_code'         => [
                                               'required',
                                               'digits:6',
                                               new SecurityCodeCheckRule($this),
                                              ],
                   'password'              => [
                                               'required',
                                               'confirmed',
                                               //(必须存在大写+小写+数字的7到15位)
                                               'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d].{7,15}$/',
                                              ],
                   'password_confirmation' => 'required',
                  ];
        return $result;
    }
}
