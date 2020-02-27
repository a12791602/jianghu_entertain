<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Backend\Menu;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for menu all require infos request.
 */
class AllRequireInfosRequest extends BaseFormRequest
{

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['type' => '路由类型'];

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
        $rules = ['type' => 'required|integer|in:1,2,3,0'];
        return $rules;
    }
}
