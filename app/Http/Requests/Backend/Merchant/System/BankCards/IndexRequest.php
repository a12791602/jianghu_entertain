<?php

namespace App\Http\Requests\Backend\Merchant\System\BankCards;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUsersBankCard;

/**
 * 银行卡反查-列表
 */
class IndexRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [FrontendUsersBankCard::class];

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
        $mobile = ['regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/'];
        return [
                'user_id'     => 'integer',              //用户UID
                'mobile'      => $mobile,                //用户手机号
                'bank_id'     => 'integer',              //银行ID
                'card_number' => 'digits_between:13,19', //银行卡号
                'created_at'  => 'string',               //绑定时间
               ];
    }
}
