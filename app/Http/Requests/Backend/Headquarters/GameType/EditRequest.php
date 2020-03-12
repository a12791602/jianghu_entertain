<?php

namespace App\Http\Requests\Backend\Headquarters\GameType;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\GameType;

/**
 * Class EditRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameType
 */
class EditRequest extends BaseFormRequest
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
        $myId  = $this->get('id');
        $rules = [
                  'id'    => 'required|exists:game_types,id',
                  'name'  => 'required|unique:game_types,name,' . $myId,
                  'sign'  => 'required|string|unique:game_types,sign,' . $myId,
                  'model' => 'required|string',
                 ];
        return $rules;
    }
}
