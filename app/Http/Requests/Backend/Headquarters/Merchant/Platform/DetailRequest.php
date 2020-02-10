<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 * Class DetailRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class DetailRequest extends BaseFormRequest
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
                'email'     => 'email|max:64',  //邮箱
                'maintain'  => 'in:0,1',        //维护状态
                'status'    => 'in:0,1',        //状态
                'createdAt' => 'string',        //生成时间
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'email.email'      => '邮箱格式不正确',
                'email.max'        => '邮箱不能超过64个字符',
                'maintain.in'      => '维护状态数据非法',
                'status.in'        => '站点状态数据非法',
                'createdAt.string' => '站点添加时间数据格式不正确',
               ];
    }
}
