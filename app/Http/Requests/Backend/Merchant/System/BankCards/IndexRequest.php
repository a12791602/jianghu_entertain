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
        $mobile = ['regex:/^1[345789]\d{9}$/'];//(手机号码第一位1第二位345789总共11位数字)
        return [
                'user_id'      => 'integer',              //用户UID
                'mobile'       => $mobile,                //用户手机号
                'bank_id'      => 'integer',              //银行ID
                'card_number'  => 'digits_between:13,19', //银行卡号
                'created_at'   => 'array|size:2',         //绑定时间
                'created_at.*' => 'date',                 //绑定时间
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['created_at' => 'cast:array'];
    }
}
