<?php

namespace App\Http\Requests\Backend\Merchant\Activity\Dynamic;

use App\Http\Requests\BaseFormRequest;
use App\Services\FactoryService;

/**
 * Class StatusRequest
 * @package App\Http\Requests\Backend\Merchant\Activity\Dynamic
 */
class StatusRequest extends BaseFormRequest
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
                'id'     => 'required|exists:system_dyn_activity_platforms,id',
                'status' => 'required|in:' . $const::STATUS_DISABLE . ',' . $const::STATUS_NORMAL,
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'     => 'ID不存在',
                'id.exists'       => 'ID不存在',
                'status.required' => '请选择状态',
                'status.in'       => '所选状态不在范围内',
               ];
    }
}
