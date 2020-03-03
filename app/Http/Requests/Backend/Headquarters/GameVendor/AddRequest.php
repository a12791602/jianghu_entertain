<?php

namespace App\Http\Requests\Backend\Headquarters\GameVendor;

use App\Http\Requests\BaseFormRequest;

/**
 * Class AddRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameVendor
 */
class AddRequest extends BaseFormRequest
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
     * @return array
     */
    public function rules(): array
    {
        $result = [
                   'name'               => 'required|unique:game_vendors,name',
                   'sign'               => ['required', 'regex:/\w+/', 'unique:game_vendors,sign'],
                   'whitelist_ips'      => 'array',
                   'whitelist_ips.*'    => 'ip',
                   'type_id'            => 'required|integer',
                   'urls'               => 'array',
                   'test_urls'          => 'array',
                   'app_id'             => 'string|nullable',
                   'authorization_code' => 'string',
                   'merchant_id'        => 'string',
                   'merchant_secret'    => 'string',
                   'public_key'         => 'string',
                   'private_key'        => 'string',
                   'des_key'            => 'string',
                   'md5_key'            => 'string',
                   'status'             => 'required|in:0,1',
                  ];
        return $result;
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        $message = [
                    'name.required'       => '请填写游戏厂商名称',
                    'name.unique'         => '游戏厂商名称已存在',
                    'sign.required'       => '请填写游戏厂商标记',
                    'sign.regex'          => '游戏厂商标记只能包含数字,字母,下划线',
                    'sign.unique'         => '游戏厂商标记已存在',
                    'whitelist_ips.array' => 'ip白名单格式不正确',
                    'whitelist_ips.*.ip'  => 'ip格式不正确',
                    'status.required'     => '请选择状态',
                    'status.in'           => '所选择状态不存在',
                   ];
        return $message;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            'whitelist_ips' => 'cast:array',
        ];
    }
}
