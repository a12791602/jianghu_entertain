<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Rules\Frontend\SecurityCodeCheckRule;

/**
 * Class AccountDestroyRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class AccountDestroyRequest extends BaseFormRequest
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
                   'card_id'           => 'required',
                   'owner_name'        => [
                                           'required',
                                           'regex:/^[\x{4e00}-\x{9fa5}].{1,5}$/u', //(1-5个中文)
                                          ],
                   'security_code'     => [
                                           'required',
                                           'digits:6',
                                           new SecurityCodeCheckRule($this),
                                          ],
                   'verification_key'  => 'required|string',
                   'verification_code' => 'required',
                  ];
        return $result;
    }

    /**
     * Get custom messages for validator errors.
     * @return mixed[]
     */
    public function messages(): array
    {
        return ['owner_name.regex' => '姓名输入有误，请重新输入。'];
    }
}
