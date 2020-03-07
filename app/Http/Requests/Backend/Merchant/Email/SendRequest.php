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
     * 需要依赖模型中的字段备注信息
     * @var array<int,string>
     */
    protected $dependentModels = [SystemEmail::class];

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = [
                                  'is_head'     => '是否发往总控',
                                  'receivers.*' => '收件人',
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
                'is_head'     => 'required|integer|in:0,1',
                'receivers'   => 'required_if:is_head,0|array',
                'receivers.*' => 'required_if:is_head,0|string|min:7|distinct|exists:frontend_users,guid',
                'title'       => 'required|string|min:1|max:16',
                'content'     => 'required|string|min:1|max:1000',
                'is_timing'   => 'required|integer|in:' . SystemEmail::IS_TIMING_NO . ',' . SystemEmail::IS_TIMING_YES,
                'send_time'   => 'required_if:is_timing,' . SystemEmail::IS_TIMING_YES . '|date|after:now',
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
