<?php

namespace App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceChannel;

/**
 * Class AddDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\FinanceChannel
 */
class AddDoRequest extends BaseFormRequest
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
        return [
                'type_id'      => 'required|exists:system_finance_types,id',
                'vendor_id'    => 'required|exists:system_finance_vendors,id',
                'name'         => 'required|unique:system_finance_channels,name',
                'sign'         => 'required|unique:system_finance_channels,sign|regex:/\w+/', //(字母+下划线)
                'request_mode' => 'required|in:0,1',
                'banks_code'   => 'string',
                'status'       => 'required|in:0,1',
                'desc'         => 'string',
               ];
    }
}
