<?php

namespace App\Http\Requests\Backend\Merchant\Notice\Login;

use App\Http\Requests\BaseFormRequest;
use App\Lib\Constant\JHHYCnst;

/**
 * Class AddDoRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Login
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
        $deviceRule = 'required|in:' . JHHYCnst::DEVICE_PC . ',' . JHHYCnst::DEVICE_H5 . ',' . JHHYCnst::DEVICE_APP;
        return [
                'title'      => 'required|string|max:64',
                'pic'        => 'required|string|max:128',
                'link'       => 'required|string|max:128',
                'start_time' => 'required|date',
                'end_time'   => 'required|date|after:start_time',
                'status'     => 'required|in:' . JHHYCnst::STATUS_DISABLE . ',' . JHHYCnst::STATUS_OPEN,
                'device'     => $deviceRule,
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'title.required'      => '请填写公告标题',
                'title.max'           => '公告标题不能超过五个字',
                'pic.required'        => '请上传图片',
                'link.required'       => '请填写跳转链接',
                'start_time.required' => '请选择开始时间',
                'start_time.date'     => '开始时间格式不正确',
                'end_time.required'   => '请选择结束时间',
                'end_time.date'       => '结束时间格式不正确',
                'end_time.after'      => '结束时间必须大于开始时间',
                'status.required'     => '请选择状态',
                'status.in'           => '所选状态不在范围内',
                'device.required'     => '请选择设备',
                'device.in'           => '所选设备不在范围内',
               ];
    }
}
