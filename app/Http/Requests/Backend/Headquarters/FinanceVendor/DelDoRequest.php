<?php

namespace App\Http\Requests\Backend\Headquarters\FinanceVendor;

use App\Http\Requests\BaseFormRequest;

/**
 * Class DelDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\FinanceVendor
 */
class DelDoRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        if ($this->isMethod('post')) {
            $rules = [
                      'id' => 'required|exists:system_finance_vendors,id',
                     ];
            return $rules;
        }
        return [];
    }
}
