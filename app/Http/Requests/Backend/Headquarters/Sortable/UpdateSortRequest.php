<?php

namespace App\Http\Requests\Backend\Headquarters\Sortable;

use App\Http\Requests\BaseFormRequest;
use App\Rules\Backend\Common\Sortable\CheckSortableModel;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Backend\Headquarters\Sortable
 */
class UpdateSortRequest extends BaseFormRequest
{

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = [
                                  'sort'        => '排序',
                                  'sort.*.key'  => '排序数组的键',
                                  'sort.*.sort' => '排序数组的顺序',
                                  'model_type'  => '模型类型',
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
        $rules = [
                  'sort'        => 'required|array',
                  'sort.*.key'  => 'numeric',
                  'sort.*.sort' => 'numeric',
                  'model_type'  => [
                                    'required',
                                    'numeric',
                                    'in:1,2',
                                    new CheckSortableModel($this),
                                   ],
                 ];
        return $rules;
    }
}
