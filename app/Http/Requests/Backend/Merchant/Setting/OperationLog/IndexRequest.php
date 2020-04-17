<?php

namespace App\Http\Requests\Backend\Merchant\Setting\OperationLog;

use App\Http\Requests\BaseFormRequest;
use App\Models\Systems\SystemLogsMerchant;

/**
 * 操作日志-列表
 */
class IndexRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemLogsMerchant::class];

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
                'data_ip'      => 'ip',                    //IP
                'admin_name'   => 'string|max:64',         //管理员名称
                'created_at'   => 'array|size:2',          //操作时间
                'created_at.*' => 'date',                  //操作时间
                'pageSize'     => 'integer|between:1,100', //每页数据条数
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['created_at' => 'cast:array'];
    }
}
