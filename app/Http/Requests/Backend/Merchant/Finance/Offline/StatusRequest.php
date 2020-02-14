<?php

namespace App\Http\Requests\Backend\Merchant\Finance\Offline;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceOfflineInfo;

/**
 * Class StatusRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\Offline
 */
class StatusRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceOfflineInfo::class];

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
                'id'     => 'required|integer|exists:system_finance_offline_infos,id',
                'status' => 'required|integer|in:0,1',
               ];
    }
}
