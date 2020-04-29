<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\SmsConfig;

use App\Http\Requests\BaseFormRequest;
use App\Models\Systems\SystemSmsConfig;

/**
 * 短信配置-编辑
 */
class EditRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemSmsConfig::class];

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
                'id'          => 'required|exists:system_sms_configs', //ID
                'name'        => 'required|string|max:16',             //商户名称
                'sms_num'     => 'required|integer|gte:0',             //短信数量
                'is_increase' => 'required|integer|in:1,2',            //短信数量
               ];
    }
}
