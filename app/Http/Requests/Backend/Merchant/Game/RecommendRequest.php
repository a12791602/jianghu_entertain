<?php

namespace App\Http\Requests\Backend\Merchant\Game;

use App\Http\Requests\BaseFormRequest;

/**
 * Class RecommendRequest
 * @package App\Http\Requests\Backend\Merchant\Game
 */
class RecommendRequest extends BaseFormRequest
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
                'id'           => 'required|exists:game_platforms,id',
                'is_recommend' => 'required|in:0,1',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required'           => 'ID不存在',
                'id.exists'             => 'ID不存在',
                'is_recommend.required' => '请选择是否推荐',
                'is_recommend.in'       => '所选是否推荐不在范围内',
               ];
    }
}
