<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\LoginLog;

use App\Http\Requests\BaseFormRequest;
use App\Models\Admin\BackendAdminUser;

/**
 * 管理员登录日志
 */
class IndexRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [BackendAdminUser::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'loginIp'  => 'ip',
                                  'createAt' => '登录时间',
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
        return [
                'email'    => 'email:rfc,dns',
                'name'     => 'string',
                'loginIp'  => 'ip',
                'createAt' => 'string',
                'pageSize' => 'integer|between:1,100', //每页数据条数
               ];
    }
}
