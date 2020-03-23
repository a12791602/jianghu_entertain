<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 *  Class UnassignActivitiesRequest
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class UnassignActivitiesRequest extends BaseFormRequest
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
                'name'          => 'string|min:1|max:16',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'platform_sign.required' => '请选择平台',
                'platform_sign.exists'   => '所选择平台不存在',
                'name.min'               => '活动名称最少1个字符',
                'name.max'               => '活动名称最多16个字符',
               ];
    }
}
