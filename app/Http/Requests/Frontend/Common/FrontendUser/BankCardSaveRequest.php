<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Rules\Frontend\AccountManagement\AccountUnique;

/**
 * Class BankCardAddRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class BankCardSaveRequest extends BaseFormRequest
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
                   'branch'        => [
                                       'string',
                                       'required',
                                       'regex:/^[\x{4e00}-\x{9fa5}0-9]+$/u',
                                      ],
                   'owner_name'    => [
                                       'string',
                                       'required',
                                       'regex:/^[\x{4e00}-\x{9fa5}].{1,5}$/u',
                                      ],
                   'card_number'   => [
                                       'required',
                                       'digits_between:13,19',
                                       new AccountUnique($this),
                                      ],
                   'code'          => 'alpha|required',  // 银行编码
                   'bank_id'       => 'integer|required', // 银行 id
                   'fund_password' => [
                                       'required',
                                       'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d].{7,15}$/',
                                       'confirmed',
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
        $result = [
                   'owner_name.required'        => '姓名不能为空。',
                   'branch.regex'               => '开户行输入有误，请重新输入。',
                   'card_number.digits_between' => '卡号输入有误，请重新输入。',
                   'owner_name.regex'           => '姓名输入有误，请重新输入。',
                   'fund_password.required'     => '取款密码不能为空。',
                   'fund_password.regex'        => '取款密码不符合规则。',
                   'fund_password.confirmed'    => '取款密码两次输入不一致。',
                  ];
        return $result;
    }
}
