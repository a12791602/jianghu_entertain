<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for do add request.
 */
class DomainAddRequest extends BaseFormRequest
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
     * Get the validation rules that apply to the request .
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
                'platform_sign' => 'required|exists:system_platforms,sign', //平台标识
                'domain'        => 'required|unique:system_domains',        //域名
                'type'          => 'required|in:0,1,2,3',                   //类型 0.主域名 1.PC 2.H5 3.APP
                'status'        => 'required|in:0,1',                       //状态 0关闭 1开启
               ];
    }

    /**
     * 返回信息
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'platform_sign.required' => '缺少平台标识',
                'platform_sign.exists'   => '该平台不存在',
                'domain.required'        => '缺少域名',
                'domain.unique'          => '该域名已被绑定',
               ];
    }
}
