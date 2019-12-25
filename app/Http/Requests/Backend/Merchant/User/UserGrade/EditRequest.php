<?php

namespace App\Http\Requests\Backend\Merchant\User\UserGrade;

use App\Http\Requests\BaseFormRequest;

/**
 * 用户等级-编辑
 */
class EditRequest extends BaseFormRequest
{
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
            'id'             => 'required|exists:users_grades', //ID
            'name'           => 'required|alpha_num|max:5',     //等级名称
            'experience_min' => 'required|numeric|gte:0',       //最小经验值
            'experience_max' => 'gte:experience_min',           //最大经验值
            'grade_gift'     => 'required|numeric|gte:0',       //晋级奖励
            'week_gift'      => 'required|numeric|gte:0',       //周奖励
        ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'id.exists'               => '该等级配置不存在',
            'experience_min.required' => '缺少该等级最小经验值',
            'experience_min.numeric'  => '等级最小经验值必须是数字',
            'experience_min.gte'      => '等级最小经验值必须大于等于0',
            'experience_max.gte'      => '等级最大经验值必须大于最小经验值',
            'grade_gift.required'     => '缺少晋级奖励',
            'grade_gift.numeric'      => '晋级奖励必须是数字',
            'grade_gift.gte'          => '晋级奖励必须大于等于0',
            'week_gift.required'      => '缺少周奖励',
            'week_gift.numeric'       => '周奖励必须是数字',
            'week_gift.gte'           => '周奖励必须大于等于0',
        ];
    }
}
