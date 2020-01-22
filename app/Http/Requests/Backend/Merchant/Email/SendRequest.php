<?php

namespace App\Http\Requests\Backend\Merchant\Email;

use App\Http\Requests\BaseFormRequest;
use App\Models\Email\SystemEmail;

/**
 * Class SendRequest
 * @package App\Http\Requests\Backend\Merchant\Email
 */
class SendRequest extends BaseFormRequest
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
                'is_head'     => 'in:0,1',
                'receivers'   => 'required_if:is_head,0|array',
                'receivers.*' => 'required_if:is_head,0|distinct|exists:frontend_users,uid',
                'title'       => 'required|string',
                'content'     => 'required|string',
                'is_timing'   => 'required|in:' . SystemEmail::IS_TIMING_NO . ',' . SystemEmail::IS_TIMING_YES,
                'send_time'   => 'required_if:is_timing,' . SystemEmail::IS_TIMING_YES . '|date|after:now',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'is_head.in'              => '是否是总控邮件参数错误',
                'receivers.required_if'   => '请填写收件人',
                'receivers.array'         => '收件人格式错误',
                'receivers.*.required_if' => '请填写收件人',
                'receivers.*.exists'      => '收件人不存在',
                'receivers.*.distinct'    => '收件人不能重覆',
                'title.required'          => '请填写邮件标题',
                'title.string'            => '邮件标题格式错误',
                'content.required'        => '请输入邮件内容',
                'content.string'          => '邮件内容格式错误',
                'is_timing.required'      => '请选择邮件发送方式',
                'is_timing.in'            => '所选邮件发送方式不在范围内',
                'send_time.required_if'   => '请填写延时发送时间',
                'send_time.date'          => '延时发送时间格式不正确',
                'send_time.after'         => '延时发送时间必须晚于当前时间',
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['receivers' => 'cast:array'];
    }
}
