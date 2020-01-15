<?php

namespace App\Http\Requests\Frontend\H5\Recharge;

use App\Http\Requests\BaseFormRequest;

/**
 * Class ChannelsRequest
 * @package App\Http\Requests\Frontend\H5\Recharge
 */
class ChannelsRequest extends BaseFormRequest
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
        return ['type_id' => 'required|exists:system_finance_types,id'];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'type_id.required' => '请选择分类',
                'type_id.exists'   => '所选分类不存在',
               ];
    }
}
