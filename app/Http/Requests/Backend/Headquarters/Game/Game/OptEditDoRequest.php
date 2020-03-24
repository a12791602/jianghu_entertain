<?php

namespace App\Http\Requests\Backend\Headquarters\Game\Game;

use App\Http\Requests\BaseFormRequest;

/**
 * Class OptEditDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Game
 */
class OptEditDoRequest extends BaseFormRequest
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
        $thisId = $this->get('id');
        return [
                'id'                 => 'required|exists:games,id',
                'name'               => 'required|unique:games,name,' . $thisId,
                'app_id'             => 'string',
                'authorization_code' => 'string',
                'merchant_code'      => 'string',
                'merchant_secret'    => 'string',
                'public_key'         => 'string',
                'private_key'        => 'string',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'               => 'ID不存在',
                'id.exists'                 => 'ID不存在',
                'name.required'             => '请填写游戏名称',
                'name.unique'               => '游戏名称已存在',
                'app_id.string'             => '终端号格式错误',
                'authorization_code.string' => '授权码格式错误',
                'merchant_code.string'      => '商户号格式错误',
                'merchant_secret.string'    => '商户密钥格式错误',
                'public_key.string'         => '第三方公钥格式错误',
                'private_key.string'        => '第三方私钥格式错误',
               ];
    }
}
