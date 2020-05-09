<?php

namespace App\Http\Requests\Backend\Merchant\Game;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\Game;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Game
 */
class IndexRequest extends BaseFormRequest
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
                'device'    => 'integer|in:1,2,3',          //服务端 1.PC 2.H5 3.APP
                'vendor_id' => 'integer|exists:game_vendors,id',
                'name'      => 'string|max:64',
                'type_id'   => 'integer|exists:game_types,id',
                'status'    => 'integer|in:0,1',
                'hot_new'   => 'integer|in:0,1',
                'pageSize'  => 'integer|between:1,100',     //每页数据条数
               ];
    }
}
