<?php

namespace App\Http\Requests\Backend\Merchant\User\UserGrade;

use App\Http\Requests\BaseFormRequest;

/**
 * 用户等级-添加
 */
class DoAddRequest extends BaseFormRequest
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
                'name'           => 'required|alpha_num|max:5', //等级名称
                'experience_min' => 'required|numeric|gte:0',   //最小经验值
                'experience_max' => 'gte:experience_min',       //最大经验值
                'level_gift'     => 'required|numeric|gte:0',   //晋级奖励
                'weekly_gift'    => 'required|numeric|gte:0',   //周奖励
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'experience_min.required' => '缺少该等级最小经验值',
                'experience_min.numeric'  => '等级最小经验值必须是数字',
                'experience_min.gte'      => '等级最小经验值必须大于等于0',
                'experience_max.gte'      => '等级最大经验值必须大于最小经验值',
                'level_gift.required'     => '缺少晋级奖励',
                'level_gift.numeric'      => '晋级奖励必须是数字',
                'level_gift.gte'          => '晋级奖励必须大于等于0',
                'weekly_gift.required'    => '缺少周奖励',
                'weekly_gift.numeric'     => '周奖励必须是数字',
                'weekly_gift.gte'         => '周奖励必须大于等于0',
               ];
    }
}
