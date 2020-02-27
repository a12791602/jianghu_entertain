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
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'game_types_id'  => '游戏主类型',
                                  'game_series_id' => '游戏子类型',
                                 ];

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
                'game_types_id'  => 'required|integer|gt:0|exists:game_types,id',
        //            'sub_types_id'=> 'required|exists:games_types,sub-types_id',
                'game_series_id' => 'required|integer|gt:0|exists:games,id',
               ];
    }
}
