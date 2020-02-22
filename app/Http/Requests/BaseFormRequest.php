<?php

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 6/5/2019
 * Time: 8:06 PM
 */

namespace App\Http\Requests;

/**
 * Class BaseFormRequest
 * @package App\Http\Requests
 */
class BaseFormRequest extends BaseFormAbstractRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return [];
    }

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
     * @return mixed[] attributes set for request.
     */
    public function attributes(): array
    {
        $attribute = [];
        foreach ($this->dependentModels as $dependentModel) {
            if (!isset($dependentModel::$fieldDefinition)) {
                continue;
            }
            $tmpVar    = $dependentModel::$fieldDefinition;
            $attribute = array_merge($tmpVar, $attribute);
        }
        $attribute = array_merge($attribute, $this->extraDefinition);
        return $attribute;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return BaseFormRequest[]
     */
    public function validationData(): array
    {
        $params = array_merge($this->all(), $this->route()->parameters());
        return $params;
    }
}
