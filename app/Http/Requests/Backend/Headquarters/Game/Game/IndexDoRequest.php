<?php

namespace App\Http\Requests\Backend\Headquarters\Game\Game;

use App\Http\Requests\BaseFormRequest;

/**
 * Class IndexDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Game
 */
class IndexDoRequest extends BaseFormRequest
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
                'game_id'   => 'integer',
                'vendor_id' => 'integer',
                'type_id'   => 'integer',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'game_id.integer'   => '游戏ID不符合规则',
                'vendor_id.integer' => '游戏厂商ID不符合规则',
                'type_id.integer'   => '游戏分类ID不符合规则',
               ];
    }
}
