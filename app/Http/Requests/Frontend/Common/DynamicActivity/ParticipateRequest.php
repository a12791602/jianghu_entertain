<?php

namespace App\Http\Requests\Frontend\Common\DynamicActivity;

use App\Http\Requests\BaseFormRequest;
use App\Models\Activity\ActivitiesDynPlatform;

/**
 * Class ResetPasswordRequest
 * @package App\Http\Requests\Frontend\Common
 */
class ParticipateRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [ActivitiesDynPlatform::class];
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
        return ['activity_dyn_id' => 'required|integer|exists:activities_dyn_platforms,activity_dyn_id'];
    }
}
