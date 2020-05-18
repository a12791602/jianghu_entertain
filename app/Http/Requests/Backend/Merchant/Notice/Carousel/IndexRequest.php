<?php

namespace App\Http\Requests\Backend\Merchant\Notice\Carousel;

use App\Http\Requests\BaseFormRequest;
use App\JHHYLibs\JHHYCnst;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Carousel
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
        $deviceRule = 'required|in:' . JHHYCnst::DEVICE_PC . ',' . JHHYCnst::DEVICE_H5 . ',' . JHHYCnst::DEVICE_APP;
        return [
                'title'    => 'string|max:64',
                'device'   => $deviceRule,
                'pageSize' => 'integer|between:1,100',     //每页数据条数
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'device.required' => '请选择设备',
                'device.in'       => '所选设备不在范围内',
               ];
    }
}
