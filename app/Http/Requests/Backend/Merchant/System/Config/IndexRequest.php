<?php

namespace App\Http\Requests\Backend\Merchant\System\Config;

use App\Http\Requests\BaseFormRequest;
use App\Models\Systems\SystemConfiguration;

/**
 * 全域设置-列表
 */
class IndexRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemConfiguration::class];

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
        return ['sign' => 'required|array'];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['sign' => 'cast:array'];
    }
}
