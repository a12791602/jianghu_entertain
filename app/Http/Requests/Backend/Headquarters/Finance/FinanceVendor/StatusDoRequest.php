<?php

namespace App\Http\Requests\Backend\Headquarters\Finance\FinanceVendor;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceVendor;

/**
 * Class StatusDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Finance\FinanceVendor
 */
class StatusDoRequest extends BaseFormRequest
{

    /**
     * 需要依赖模型中的字段备注信息
     * @var array<int,string>
     */
    protected $dependentModels = [SystemFinanceVendor::class];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        $rules = [
                  'id' => 'required|exists:system_finance_vendors,id',
                  'status' => 'required|in:0,1',
                 ];
        return $rules;
    }
}
