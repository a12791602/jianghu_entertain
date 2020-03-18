<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Rules\Frontend\AccountManagement\AccountUnique;

/**
 * Class BankCardBindingRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class BankCardBindingRequest extends BaseFormRequest
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
                   'branch'      => [
                                     'string',
                                     'required',
                                     'regex:/^[\x{4e00}-\x{9fa5}0-9]+$/u', //(中文+数字)
                                    ],
                   'owner_name'  => [
                                     'string',
                                     'required',
                                     'regex:/^[\x{4e00}-\x{9fa5}].{1,5}$/u', //(1-5位中文)
                                    ],
                   'card_number' => [
                                     'required',
                                     'digits_between:13,19',
                                     new AccountUnique($this),
                                    ],
                   'code'        => 'alpha|required',  // 银行编码
                   'bank_id'     => 'integer|required', // 银行 id
                  ];
        return $result;
    }

    /**
     * Get custom messages for validator errors.
     * @return mixed[]
     */
    public function messages(): array
    {
        $result = [
                   'owner_name.required'        => '姓名不能为空。',
                   'branch.regex'               => '开户行输入有误，请重新输入。',
                   'card_number.digits_between' => '卡号输入有误，请重新输入。',
                   'owner_name.regex'           => '姓名输入有误，请重新输入。',
                  ];
        return $result;
    }
}
