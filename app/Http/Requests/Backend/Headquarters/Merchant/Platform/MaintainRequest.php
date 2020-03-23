<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;
use App\Models\Systems\SystemPlatform;

/**
 *  Class for maintain request.
 */
class MaintainRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemPlatform::class];
    
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
                'id'             => 'required|exists:system_platforms',             //ID
                'maintain_start' => 'date_format:Y-m-d H:i:s',                      //维护开始时间
                'maintain_end'   => 'date_format:Y-m-d H:i:s|after:maintain_start', //维护结束时间
               ];
    }
}
