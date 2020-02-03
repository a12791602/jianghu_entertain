<?php

namespace App\Http\Requests\Frontend\H5\Recharge;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceChannel;

/**
 * Class ChannelsRequest
 * @package App\Http\Requests\Frontend\H5\Recharge
 */
class ChannelsRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceChannel::class];

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
        return ['type_id' => 'required|integer|min:1|exists:system_finance_types,id'];
    }
}
