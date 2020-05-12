<?php

namespace App\Http\Requests\Backend\Merchant\Game;

use App\Http\Requests\BaseFormRequest;

/**
 * Class IconRequest
 * @package App\Http\Requests\Backend\Merchant\Game
 */
class IconRequest extends BaseFormRequest
{

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = ['icon_id' => '游戏图标'];

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
                'id'      => 'required|integer|min:1|exists:game_platforms',
                'icon_id' => 'required|integer|exists:static_resources,id',
               ];
    }
}
