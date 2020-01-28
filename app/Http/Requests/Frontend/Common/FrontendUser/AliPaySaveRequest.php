<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Rules\Frontend\AccountManagement\AccountUnique;
use App\Rules\Frontend\CheckSecurityCode;

/**
 * Class AliPayAddRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class AliPaySaveRequest extends BaseFormRequest
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
                   'card_number'   => [
                                       'required',
                                       new AccountUnique($this),
                                      ],
                   'type'          => 'integer:required',// 1 储蓄卡 2 支付宝
                   'code'          => 'alpha:required',  // 银行编码
                   'bank_id'       => 'integer:required',
                   'security_code' => [
                                       'string',
                                       'required',
                                       'digits:6',
                                       'confirmed',
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
        return [
                'owner_name.required'     => '姓名不能为空。',
                'card_number.required'    => '账号不能为空。',
                'owner_name.regex'        => '姓名输入有误，请重新输入。',
                'security_code.confirmed' => '安全码两次输入不一致。',
               ];
    }
}
