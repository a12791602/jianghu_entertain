<?php

namespace App\Http\Requests\Backend\Merchant\User\UserGrade;

use App\Http\Requests\BaseFormRequest;
use App\Models\User\FrontendUserLevel;

/**
 * 用户等级-删除
 */
class DeleteRequest extends BaseFormRequest
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
        $rules = ['id' => 'required|exists:frontend_user_levels']; //ID
        return $rules;
    }
}
