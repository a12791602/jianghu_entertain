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
                'platform_id' => 'required|exists:system_platforms,id',
                'game_ids'    => 'required|array',
                'game_ids.*'  => [
                                  'required',
                                  'exists:game_platforms,game_id',
                                 ],
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'platform_id.required' => '请选择厅主',
                'platform_id.exists'   => '所选厅主不存在',
                'game_ids.required'    => '请选择游戏',
                'game_ids.array'       => '游戏格式不正确',
                'game_ids.*.required'  => '请选择游戏',
                'game_ids.*.exists'    => '所选游戏尚未分配',
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['game_ids' => 'cast:array'];
    }
}
