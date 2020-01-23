<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 * Class AssignedActivityCancelRequest
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class AssignedActivityCancelRequest extends BaseFormRequest
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
                'platform_sign' => 'required|exists:system_platforms,sign',
                'activities'    => 'required|array',
                'activities.*'  => [
                                    'required',
                                    'exists:system_dyn_activity_platforms,activity_sign',
                                   ],
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'platform_sign.required' => '请选择厅主',
                'platform_sign.exists'   => '所选厅主不存在',
                'activities.required'    => '请选择活动',
                'activities.array'       => '活动格式不正确',
                'activities.*.required'  => '请选择活动',
                'activities.*.exists'    => '所选活动尚未分配',
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['activities' => 'cast:array'];
    }
}
