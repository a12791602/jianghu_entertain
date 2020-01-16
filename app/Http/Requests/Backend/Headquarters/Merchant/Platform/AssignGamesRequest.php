<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

/**
 * Class AssignGamesRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class AssignGamesRequest extends BaseFormRequest
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
        $platformSign = $this->get('platform_sign');
        $unique       = Rule::unique('games_platforms', 'game_sign')
            ->where('platform_sign', $platformSign);
        return [
                'platform_sign' => 'required|exists:system_platforms,sign',
                'game_signs'    => 'required|array',
                'game_signs.*'  => [
                                    'required',
                                    'exists:games,sign',
                                    $unique,
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
                'game_signs.*.exists'    => '所选游戏不存在',
                'game_signs.*.unique'    => '您所选的游戏已经分配过了',
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
