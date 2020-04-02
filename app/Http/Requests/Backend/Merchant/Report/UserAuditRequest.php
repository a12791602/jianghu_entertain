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
                'mobile'       => 'string|regex:/^1[345789]\d{9}$/', //会员账号(手机号码第一位1第二位345789总共11位数字)
                'guid'         => 'string|max:16',                   //会员UID
                'created_at'   => 'array|size:2',                    //生成时间
                'created_at.*' => 'date|date_format:Y-m-d H:i:s',    //生成时间
                'status'       => 'integer|in:0,1',                  //状态 0未完成 1已完成
                'pageSize'     => 'integer|between:1,100',           //每页数据条数
               ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['created_at' => 'cast:array'];
    }
}
