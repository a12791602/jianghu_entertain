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
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'card_id'           => '卡号ID',
                                  'security_code'     => '安全码',
                                  'owner_name'        => '姓名',
                                  'verification_code' => '验证码',
                                 ];

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
    }
}
