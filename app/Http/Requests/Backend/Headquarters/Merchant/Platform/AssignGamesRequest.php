<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\Game;
use Illuminate\Validation\Rule;

/**
 *  Class AssignGamesRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class AssignGamesRequest extends BaseFormRequest
{

    /**
     * 需要依赖模型中的字段备注信息
     * @var array<int,string>
     */
    protected $dependentModels = [Game::class];

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = [
                                  'game_ids'   => '游戏ID',
                                  'game_ids.*' => '游戏ID',
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
        $platform = $this->get('platform_id');
        $unique   = Rule::unique('game_platforms', 'game_id')
            ->where('platform_id', $platform);
        return [
                'platform_id' => 'required|exists:system_platforms,id',
                'game_ids'    => 'required|array',
                'game_ids.*'  => [
                                  'required',
                                  'exists:games,id',
                                  $unique,
                                 ],
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
