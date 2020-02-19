<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Rules\Frontend\AccountManagement\FundPasswordCheckRule;

/**
 * Class WithdrawalRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class WithdrawalRequest extends BaseFormRequest
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
                   'bank_id'       => 'integer:required', // 收款账户 ID
                   'amount'        => [
                                       'required',
                                       'regex:/^([1-9][0-9]*)+(.[0-9]{1,2})?$/',
                                      ], // 提现金额
                   'fund_password' => [
                                       'required',
                                       'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d].{7,15}$/', // 大小写字母加数字 8,16位
                                       new FundPasswordCheckRule($this),
                                      ], // 资金密码
                  ];
        return $result;
    }

    /**
     * Get custom messages for validator errors.
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'amount.required'        => '提现金额不能为空。',
                'amount.regex'           => '提现金额格式不正确。',
                'fund_password.required' => '取款密码不能为空。',
                'fund_password.regex'    => '取款密码格式不正确。',
               ];
    }
}
