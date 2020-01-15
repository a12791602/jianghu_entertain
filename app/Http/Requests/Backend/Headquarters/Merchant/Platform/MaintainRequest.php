<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for maintain request.
 */
class MaintainRequest extends BaseFormRequest
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
                'id'             => 'required|exists:system_platforms',             //ID
                'maintain_start' => 'date_format:Y-m-d H:i:s',                      //维护开始时间
                'maintain_end'   => 'date_format:Y-m-d H:i:s|after:maintain_start', //维护结束时间
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'                => '缺少站点ID',
                'id.exists'                  => '该站点不存在',
                'maintain_start.date_format' => '维护时间的时间格式只能是Y-m-d H:i:s',
                'maintain_end.date_format'   => '维护时间的时间格式只能是Y-m-d H:i:s',
                'maintain_end.after'         => '维护结束时间必须大于开始时间',
               ];
    }
}
