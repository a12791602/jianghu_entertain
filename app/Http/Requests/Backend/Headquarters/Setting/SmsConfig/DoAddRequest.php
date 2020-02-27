<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\SmsConfig;

use App\Http\Requests\BaseFormRequest;
use App\Models\Systems\SystemSmsConfig;

/**
 * 短信配置-添加
 */
class DoAddRequest extends BaseFormRequest
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
                'name'               => 'required|string|max:16',                           //商户名称
                'sign'               => 'required|string|max:10|unique:system_sms_configs', //商户标识
                'merchant_code'      => 'required|string|max:64',                           //商户号
                'merchant_secret'    => 'required|string',                                  //商户密钥
                'public_key'         => 'required|string',                                  //商户公钥
                'sms_num'            => 'required|integer|gte:0',                           //短信数量
                'authorization_code' => 'required|string|max:255',                          //授权码
                'url'                => 'required|string|max:255',                          //请求地址
               ];
    }
}
