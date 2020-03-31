<?php

namespace App\Http\Requests\Backend\Headquarters\Game\GameType;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\GameType;
use App\Rules\Backend\Common\Sortable\CheckSortableModel;

/**
 * Class StatusDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameType
 */
class StatusDoRequest extends BaseFormRequest
{

    /**
     * 需要依赖模型中的字段备注信息
     * @var array<int,string>
     */
    protected $dependentModels = [GameType::class];

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = ['category_type' => '类别类型'];

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
                'id'            => 'required|numeric|exists:game_types,id',
                'status'        => 'required|in:0,1',
                'category_type' => [
                                    'required',
                                    'numeric',
                                    'in:1,2',
                                    new CheckSortableModel($this),
                                   ],
               ];
    }
}
