<?php

namespace App\Http\Requests\Backend\Merchant\System\BankCards;

use App\Http\Requests\BaseFormRequest;

/**
 * 帮助设置-列表
 */
class IndexRequest extends BaseFormRequest
{
    
    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'uniqid'    => '用户UID',
                                  'mobile'    => '用户手机号',
                                  'bankId'    => '银行ID',
                                  'createdAt' => '绑定时间',
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
        $mobile = 'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/';
        return [
                'uniqid'    => 'integer', //用户UID
                'mobile'    => $mobile, //用户手机号
                'bankId'    => 'integer', //银行ID
                'createdAt' => 'string',  //绑定时间
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'uid.integer'       => '用户UID必须是数字',
                'mobile.regex'      => '手机号格式不正确',
                'bank_id.integer'   => '银行数据必须是数字',
                'created_at.string' => '绑定时间区间数据必须是字符串',
               ];
    }
}
