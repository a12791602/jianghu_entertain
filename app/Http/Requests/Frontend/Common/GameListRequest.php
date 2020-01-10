<?php

namespace App\Http\Requests\Frontend\Common;

use App\Http\Requests\BaseFormRequest;

/**
 * Class GameListRequest
 * @package App\Http\Requests\Frontend\Common
 */
class GameListRequest extends BaseFormRequest
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
            'device' => 'integer|required',
            'type_id' => 'integer|required',
            'is_hot' => 'integer|required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'device.integer' => '设备类型不符合规则',
            'type_id.integer' => '游戏分类ID不符合规则',
            'is_hot.integer' => '游戏分类是否热门不符合规则',
        ];
    }
}
