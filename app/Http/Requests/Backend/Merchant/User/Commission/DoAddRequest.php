<?php

namespace App\Http\Requests\Backend\Merchant\User\Commission;

use App\Http\Requests\BaseFormRequest;

/**
 * 洗码设置-添加
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
            'game_type_id'   => 'required|integer|exists:games_types,id',   //游戏类型ID
            'game_vendor_id' => 'required|integer|exists:games_vendors,id', //游戏平台ID
            'bet'            => 'required|numeric|gte:0',                   //打码量
            'percent'        => 'required|string',                          //洗码比例
        ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'bet.required' => '缺少打码量',
            'bet.numeric'  => '打码量必须是数字',
            'bet.gte'      => '打码量必须大于等于0',
        ];
    }
}
