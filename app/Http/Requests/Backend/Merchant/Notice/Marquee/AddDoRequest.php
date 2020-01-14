<?php

namespace App\Http\Requests\Backend\Merchant\Notice\Marquee;

use App\Http\Requests\BaseFormRequest;
use App\Services\FactoryService;

/**
 * Class AddDoRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Marquee
 */
class AddDoRequest extends BaseFormRequest
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
                'title'      => 'required|max:5',
                'content'    => 'required',
                'device'     => 'required|array',
                'device.*'   => 'in:' . $const::DEVICE_PC . ',' . $const::DEVICE_H5 . ',' . $const::DEVICE_APP,
                'status'     => 'in:' . $const::STATUS_DISABLE . ',' . $const::STATUS_NORMAL,
                'start_time' => 'required|date',
                'end_time'   => 'required|date|after:start_time',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'title.required'      => '请填写标题',
                'title.max'           => '标题最多不能超过五个字符',
                'content.required'    => '请填写内容',
                'device.required'     => '请选择设备',
                'device.array'        => '设备格式不正确',
                'device.*.in'         => '所选设备不在范围内',
                'status.in'           => '所选状态不在范围内',
                'start_time.required' => '请选择开始时间',
                'start_time.date'     => '开始时间不符合规则',
                'end_time.required'   => '请选择结束时间',
                'end_time.date'       => '结束时间不符合规则',
                'end_time.after'      => '结束时间必须大于开始时间',
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['device' => 'cast:array'];
    }
}
