<?php

namespace App\Http\Requests\Backend\Merchant\User\UserGrade;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUserLevel;

/**
 * 用户等级-编辑
 */
class EditRequest extends BaseFormRequest
{
    
    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [FrontendUserLevel::class];
    
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
                'id'             => 'required|exists:frontend_user_levels', //ID
                'name'           => 'required|alpha_num|max:5',             //等级名称
                'experience_min' => 'required|numeric|gte:0',               //最小经验值
                'experience_max' => 'gte:experience_min',                   //最大经验值
                'level_gift'     => 'required|numeric|gte:0',               //晋级奖励
                'weekly_gift'    => 'required|numeric|gte:0',               //周奖励
               ];
    }
}
