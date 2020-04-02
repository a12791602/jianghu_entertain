<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\SmsConfig;

use App\Http\Requests\BaseFormRequest;
use App\Models\Systems\SystemSmsConfig;

/**
 *  短信配置-列表
 */
class IndexRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemSmsConfig::class];

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
                'name'         => 'string|max:16',         //最后更新人名称
                'status'       => 'in:0,1',                //状态 0禁用 1启用
                'updated_at'   => 'array',                 //更新时间
                'updated_at.*' => 'date',                  //更新时间
                'pageSize'     => 'integer|between:1,100', //每页数据条数
               ];
    }
}
