<?php

namespace App\Http\Requests\Backend\Merchant\System\HelpCenter;

use App\Http\Requests\BaseFormRequest;
use App\Models\Systems\SystemUsersHelpCenter;

/**
 * 帮助设置-列表
 */
class IndexRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemUsersHelpCenter::class];

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
                'type'   => 'required|integer|in:1,2,3', //客户端类型 1.H5 2.PC 3.APP
                'status' => 'integer|in:0,1',            //状态 0.关闭 1.开启
                'title'  => 'string|max:32',             //标题
               ];
    }
}
