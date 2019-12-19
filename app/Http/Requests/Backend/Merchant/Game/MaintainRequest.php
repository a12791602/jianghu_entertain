<?php

namespace App\Http\Requests\Backend\Merchant\Game;

use App\Http\Requests\BaseFormRequest;

/**
 * Class MaintainRequest
 * @package App\Http\Requests\Backend\Merchant\Game
 */
class MaintainRequest extends BaseFormRequest
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
            'id' => 'required|exists:games_platforms,id',
            'is_maintain' => 'required|in:0,1',
        ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'id.required' => 'ID不存在',
            'id.exists' => 'ID不存在',
            'is_maintain.required' => '请选择是否维护',
            'is_maintain.in' => '所选是否维护不在范围内',
        ];
    }
}
