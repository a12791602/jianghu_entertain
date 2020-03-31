<?php

namespace App\Http\Requests\Backend\Merchant\Game;

use App\Http\Requests\BaseFormRequest;

/**
 * Class DoHotRequest
 * @package App\Http\Requests\Backend\Merchant\Game
 */
class DoHotRequest extends BaseFormRequest
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
                'id'      => 'required|integer|exists:game_platforms',
                'hot_new' => 'required|integer|in:0,1',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'      => 'ID不存在',
                'id.exists'        => 'ID不存在',
                'hot_new.required' => '请选择是否热门',
                'hot_new.in'       => '所选是否热门不在范围内',
               ];
    }
}
