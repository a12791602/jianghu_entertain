<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\UsersWithdrawOrder;
use App\Rules\Frontend\AccountManagement\FundPasswordCheckRule;

/**
 * Class WithdrawalRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class WithdrawalRequest extends BaseFormRequest
{

    /**
     * 需要依赖模型中的字段备注信息
     * @var array<int,string>
     */
    protected $dependentModels = [UsersWithdrawOrder::class];

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = [
                                  'bank_id'       => '账户',
                                  'fund_password' => '取款密码',
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
                'bank_id'       => 'integer|required', // 收款账户 ID
                'amount'        => [
                                    'required',
                                    'regex:/^[0-9]+(\.[0-9]{1,2})?$/',
                                   ], // 提现金额(数字+小数点2位)
                'fund_password' => [
                                    'required',
                                    'regex:/^[0-9a-zA-Z]{8,16}$/', // (大小写字母加数字 8,16位)
                                    new FundPasswordCheckRule($this),
                                   ], // 资金密码
               ];
    }
}
