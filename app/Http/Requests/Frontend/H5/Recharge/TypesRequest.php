<?php

namespace App\Http\Requests\Frontend\H5\Recharge;

use App\Http\Requests\BaseFormRequest;
use App\Models\Finance\SystemFinanceType;

/**
 * Class TypesRequest
 * @package App\Http\Requests\Frontend\H5\Recharge
 */
class TypesRequest extends BaseFormRequest
{
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
                'is_online' => 'in:' . SystemFinanceType::IS_ONLINE_NO . ',' . SystemFinanceType::IS_ONLINE_YES,
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return ['is_online.in' => '参数错误'];
    }
}
