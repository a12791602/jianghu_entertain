<?php

namespace App\Http\Requests\Backend\Headquarters\Game\Game;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\Game;

/**
 * Class EditDetailRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Game
 */
class EditDetailRequest extends BaseFormRequest
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
                'data_id'  => 'required|exists:games,id',
                'pageSize' => 'integer|between:1,100',    //每页数据条数
               ];
    }
}
