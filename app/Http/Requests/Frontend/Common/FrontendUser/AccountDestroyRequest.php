<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Rules\Frontend\CheckSecurityCode;

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
                   'owner_name'    => [
                                       'string',
                                       'required',
                                       'regex:/^[\x{4e00}-\x{9fa5}].{1,5}$/u',
                                      ],
                   'card_number'   => 'required',
                   'security_code' => [
                                       'string',
                                       'required',
                                       'digits:6',
                                       new CheckSecurityCode($this),
                                      ],
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
