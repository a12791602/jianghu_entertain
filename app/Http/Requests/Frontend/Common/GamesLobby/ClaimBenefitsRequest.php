<?php

namespace App\Http\Requests\Frontend\Common\GamesLobby;

use App\Http\Requests\BaseFormRequest;

/**
 * Class ClaimBenefitsRequest
 * @package App\Http\Requests\Frontend\Common\GamesLobby
 */
class ClaimBenefitsRequest extends BaseFormRequest
{

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'type'       => '权益类型',
                                  'other_type' => '其他权益类型',
                                  'level'      => '等级',
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
                'type'       => 'string|required',// 领取的VIP权益类型
                'other_type' => 'json|required',// 其他VIP权益领取的状态
                'level'      => 'integer|required',// 领取VIP权益的等级
               ];
    }
}
