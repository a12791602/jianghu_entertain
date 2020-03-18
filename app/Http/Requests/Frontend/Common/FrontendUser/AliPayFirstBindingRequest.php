<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Rules\Frontend\AccountManagement\AccountUnique;

/**
 * Class AliPayFirstBindingRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class AliPayFirstBindingRequest extends BaseFormRequest
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
                                       'regex:/^[\x{4e00}-\x{9fa5}].{1,5}$/u', //(1-5个中文)
                                      ],
                   'card_number'   => [
                                       'required',
                                       new AccountUnique($this),
                                      ],
                   'fund_password' => [
                                       'required',
                                       //(必须存在大写+小写+数字的7到15位)
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
        return [
                'owner_name.required'     => '姓名不能为空。',
                'card_number.required'    => '账号不能为空。',
                'owner_name.regex'        => '姓名输入有误，请重新输入。',
                'fund_password.required'  => '取款密码不能为空。',
                'fund_password.regex'     => '取款密码不符合规则。',
                'fund_password.confirmed' => '取款密码两次输入不一致。',
               ];
    }
}
