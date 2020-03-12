<?php

namespace App\Http\Requests\Backend\Headquarters\GameType;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\GameType;

/**
 * Class AddRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameType
 */
class AddRequest extends BaseFormRequest
{

    /**
     * 需要依赖模型中的字段备注信息
     * @var array<int,string>
     */
    protected $dependentModels = [GameType::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['model' => '模型'];

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
        $rules = [
                  'name'      => 'required|unique:game_types,name',
                  'sign'      => 'required|regex:/\w+/|unique:game_types,sign',
                  'status'    => 'required|in:0,1',
                  'model'     => 'required|string',
                  'parent_id' => 'numeric',
                 ];
        return $rules;
    }
}
