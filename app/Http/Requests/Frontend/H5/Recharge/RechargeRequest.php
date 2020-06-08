<?php

namespace App\Http\Requests\Frontend\H5\Recharge;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceType;

/**
 * Class RechargeRequest
 * @package App\Http\Requests\Frontend\H5\Recharge
 */
class RechargeRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceType::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'channel_id' => '通道',
                                  'money'      => '充值金额',
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
        $onLine   = 'system_finance_online_infos';
        $offLine  = 'system_finance_offline_infos';
        $isOnline = (int) $this->get('is_online');
        $table    = $isOnline === SystemFinanceType::IS_ONLINE_YES ? $onLine : $offLine;
        return [
                'is_online'     => 'required|integer|in:0,1',
                'channel_id'    => 'required|integer|min:1|exists:' . $table . ',id',
                'money'         => 'required|integer|min:1',
                'branch'        => 'required_if:is_online,0|string|max:30',
                'bank'          => 'required_if:is_online,0|string|max:30',
                'card_number'   => 'required_if:is_online,0|digits_between:13,19',
                'top_up_remark' => 'string|max:50',
               ];
    }
}
