<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\SmsConfig;

use App\Http\Requests\BaseFormRequest;

/**
 * 短信配置-添加
 */
class DoAddRequest extends BaseFormRequest
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

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'name.required'               => '缺少商户名称',
            'name.string'                 => '商户名称必须是字符串',
            'name.max'                    => '商户名称不能超过16个字符',
            'sign.required'               => '缺少商户标识',
            'sign.string'                 => '商户标识必须是字符串',
            'sign.max'                    => '商户标识不能超过10个字符',
            'sign.unique'                 => '商户标识已存在',
            'merchant_code.required'      => '缺少商户号',
            'merchant_code.string'        => '商户号必须是字符串',
            'merchant_code.max'           => '商户号不能超过64个字符',
            'merchant_secret.required'    => '缺少商户密钥',
            'merchant_secret.string'      => '商户密钥必须是字符串',
            'public_key.required'         => '缺少商户公钥',
            'public_key.string'           => '商户公钥必须是字符串',
            'sms_num.required'            => '缺少短信数量',
            'sms_num.integer'             => '短信数量必须是正整数',
            'sms_num.gte'                 => '短信数量必须是正整数',
            'authorization_code.required' => '缺少授权码',
            'authorization_code.string'   => '授权码必须是字符串',
            'authorization_code.max'      => '授权码不能超过255个字符',
            'url.required'                => '缺少请求地址',
            'url.string'                  => '请求地址必须是字符串',
            'url.max'                     => '请求地址不能超过255个字符',
        ];
    }
}
