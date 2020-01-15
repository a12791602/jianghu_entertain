<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 * Class AssignedGameCancelRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class AssignedGameCancelRequest extends BaseFormRequest
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
                'platform_sign' => 'required|exists:system_platforms,sign',
                'game_signs'    => 'required|array',
                'game_signs.*'  => [
                                    'required',
                                    'exists:games_platforms,game_sign',
                                   ],
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'platform_sign.required' => '请选择厅主',
                'platform_sign.exists'   => '所选厅主不存在',
                'game_signs.required'    => '请选择游戏',
                'game_signs.array'       => '游戏格式不正确',
                'game_signs.*.required'  => '请选择游戏',
                'game_signs.*.exists'    => '所选游戏尚未分配',
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['game_signs' => 'cast:array'];
    }
}
