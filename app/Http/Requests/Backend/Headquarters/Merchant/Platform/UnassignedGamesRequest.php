<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\Game;

/**
 *  Class UnassignGamesRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class UnassignedGamesRequest extends BaseFormRequest
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
                'platform_id' => 'required|exists:system_platforms,id',
                'vendor_id'   => 'exists:game_vendors,id',
                'game_id'     => 'exists:games,id',
                'pageSize'    => 'integer|between:1,100', //每页数据条数
               ];
    }
}
