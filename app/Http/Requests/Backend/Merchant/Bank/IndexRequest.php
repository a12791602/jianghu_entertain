<?php

namespace App\Http\Requests\Backend\Merchant\Bank;

use App\Http\Requests\BaseFormRequest;
use App\Services\FactoryService;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Bank
 */
class IndexRequest extends BaseFormRequest
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
        $const = FactoryService::getInstence()->generateService('constant');
        return [
                'name'   => 'string',
                'status' => 'in:' . $const::STATUS_NORMAL . ',' . $const::STATUS_DISABLE,
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return ['status.in' => '所选状态不在范围内'];
    }
}
