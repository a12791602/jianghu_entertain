<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUsersBankCard;
use App\Rules\Frontend\AccountManagement\AccountUnique;

/**
 * Class BankCardBindingRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class BankCardBindingRequest extends BaseFormRequest
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
        return [
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
                'bank_id'     => 'integer|required|exists:system_banks,id', // 银行 id
               ];
    }
}
