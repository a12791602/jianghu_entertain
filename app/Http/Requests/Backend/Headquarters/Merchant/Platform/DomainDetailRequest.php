<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for do add request.
 */
class DomainDetailRequest extends BaseFormRequest
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
                'sign'      => 'required|exists:system_platforms', //平台标识
                'type'      => 'required|in:0,1,2,3',              //类型 0.主域名 1.PC  2.H5  3.APP
                'domain'    => 'string',                           //域名
                'status'    => 'integer|in:0,1',                   //状态  0.关闭 1.开启
                'createdAt' => 'string',                           //添加时间
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'sign.required' => '缺少平台标识',
                'sign.exists'   => '该平台不存在',
                'type.required' => '缺少域名类型',
                'type.in'       => '域名类型数据不合法',
               ];
    }
}
