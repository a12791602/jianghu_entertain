<?php

namespace App\Http\Requests\Backend\Merchant\User\UserGrade;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUserLevelRule;

/**
 * 用户晋级规则
 */
class GradeConfigRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [FrontendUserLevelRule::class];

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
                'recharge' => 'required|numeric',            //充值金额
                'bet'      => 'required|numeric',            //打码金额
                'type'     => 'required|integer|in:1,2,3,4', //1.充值 2.打码 3.充值或打码任一满足 4.充值和打码同时满足
               ];
    }
}
