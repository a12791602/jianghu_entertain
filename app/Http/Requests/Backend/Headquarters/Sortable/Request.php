<?php

namespace App\Http\Requests\Backend\Headquarters\Sortable;

use App\Http\Requests\BaseFormRequest;

/**
 * Class Request
 *
 * @package App\Http\Requests\Backend\Headquarters\SystemBank
 */
class Request extends BaseFormRequest
{

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = [
                                  'sort'  => '排序',
                                  'model' => '模型',
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
                  'sort'  => 'required|array',
                  'model' => 'required|string',
                 ];
        return $rules;
    }
}
