<?php

namespace App\Http\Requests\Backend\Merchant\Finance\RechargeOrder;

use App\Http\Requests\BaseFormRequest;
use App\Models\Order\UsersRechargeOrder;

/**
 * Class GetFinanceTypesRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\RechargeOrder
 */
class GetFinanceTypesRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [UsersRechargeOrder::class];

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
        return ['is_online' => 'required|in:0,1'];
    }
}
