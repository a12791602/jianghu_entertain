<?php

namespace App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel;

use App\Http\Requests\BaseFormRequest;

/**
 * Class IndexDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\FinanceChannel
 */
class IndexDoRequest extends BaseFormRequest
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
                'channel_id' => 'integer',
                'type_id'    => 'integer',
                'vendor_id'  => 'integer',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'channel_id.integer' => '通道ID格式不正确',
                'type_id.integer'    => '金流分类ID格式不正确',
                'vendor_id.integer'  => '金流厂商ID格式不正确',
               ];
    }
}
