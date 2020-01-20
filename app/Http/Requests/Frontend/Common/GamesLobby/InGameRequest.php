<?php

namespace App\Http\Requests\Frontend\Common\GamesLobby;

use App\Http\Requests\BaseFormRequest;

/**
 * Class InGameRequest
 * @package App\Http\Requests\Frontend\Common\GamesLobby
 */
class InGameRequest extends BaseFormRequest
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
        return ['sign' => 'required|exists:games,sign'];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'sign.required' => '游戏不存在',
                'sign.exists'   => '游戏不存在',
               ];
    }
}
