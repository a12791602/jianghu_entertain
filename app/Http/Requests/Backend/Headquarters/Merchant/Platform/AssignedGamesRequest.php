<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\Game;

/**
 *  Class AssignedGamesRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class AssignedGamesRequest extends BaseFormRequest
{

    /**
     * 需要依赖模型中的字段备注信息
     * @var array<int,string>
     */
    protected $dependentModels = [Game::class];

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
                'platform' => 'required|exists:system_platforms,id',
                'vendor'   => 'exists:game_vendors,id',
                'game'     => 'exists:games,id',
                'page'     => 'integer|between:1,100', //页码
                'pageSize' => 'integer|between:1,100', //每页数据条数
               ];
    }
}
