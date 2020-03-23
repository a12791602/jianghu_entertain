<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 *  Class AssignedActivitiesRequest
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class AssignedActivitiesRequest extends BaseFormRequest
{
    
    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'platform_sign' => '平台标识',
                                  'name'          => '活动名称',
                                 ];

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
}
