<?php

namespace App\Http\Requests\Backend\Merchant\Finance\Online;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceOnlineInfo;

/**
 * Class BankManagementRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\Online
 */
class BankStatusRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemFinanceOnlineInfo::class];

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
                'id'     => 'required|exists:system_platform_banks,bank_id',
                'status' => 'required|in:0,1',
               ];
    }
}
