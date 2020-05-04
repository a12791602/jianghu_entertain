<?php

namespace App\Http\Requests\Frontend\Common\GamesLobby;

use App\Http\Requests\BaseFormRequest;

/**
 * Class InGameRequest
 * @package App\Http\Requests\Frontend\Common\GamesLobby
 */
class InGameResetPasswordRequest extends BaseFormRequest
{

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['vendor' => '游戏厂商类型'];

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
                'vendor'   => 'required|integer|gt:0|exists:game_vendors,id',
                'password' => 'required|alpha_num|between:5,40',
               ];
    }
}
