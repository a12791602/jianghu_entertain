<?php

namespace App\Http\Requests\Backend\Headquarters\GameType;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\GameType;
use App\Rules\Backend\Common\Sortable\CheckSortableModel;

/**
 * Class EditDoRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameType
 */
class EditDoRequest extends BaseFormRequest
{

    /**
     * 父级分类
     */
    public const CATEGORY_TYPE_PARENT = 1;

    /**
     * 子级分类
     */
    public const CATEGORY_TYPE_SUB = 2;

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
        $category_type = $this->get('category_type');
        $thisId        = $this->get('id');
        $rules         = [
                          'id'            => 'required|numeric|exists:game_types,id',
                          'category_type' => [
                                              'required',
                                              'integer',
                                              'in:1,2',
                                              new CheckSortableModel($this),
                                             ],
                         ];
        if ((int) $category_type === self::CATEGORY_TYPE_PARENT) {
            $rules['name'] = 'required|max:64|unique:game_types,name,' . $thisId;
            $rules['sign'] = 'required|max:64|unique:game_types,sign,' . $thisId . '|regex:/\w+/';//(字母+下划线)
        } else {
            $rules['name'] = 'required|max:64|unique:game_sub_types,name,' . $thisId;
            $rules['sign'] = 'required|max:64|unique:game_sub_types,sign,' . $thisId . '|regex:/\w+/';//(字母+下划线)
        }
        return $rules;
    }
}
