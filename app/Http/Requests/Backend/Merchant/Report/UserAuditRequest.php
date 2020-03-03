<?php

namespace App\Http\Requests\Backend\Merchant\Report;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUsersAudit;

/**
 * 用户稽核-列表
 */
class UserAuditRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [FrontendUsersAudit::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['createdAt' => '生成时间'];

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
                'mobile'      => 'regex:/^1[345789]\d{9}$/',     //会员账号
                'guid'        => 'string|max:16',                //会员UID
                'createdAt'   => 'array|size:2',                 //生成时间
                'createdAt.*' => 'date|date_format:Y-m-d H:i:s', //生成时间
                'status'      => 'integer|in:0,1',               //状态 0未完成 1已完成
               ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['createdAt' => 'cast:array'];
    }
}
