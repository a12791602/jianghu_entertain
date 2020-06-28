<?php

namespace App\Http\Requests\Backend\Merchant\Report;

use App\Http\Requests\BaseFormRequest;
use App\Models\Report\ReportDayUserGame;

/**
 * 会员洗码-详情
 */
class CommissionDetailRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [ReportDayUserGame::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['report_day' => '日期'];

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
                'guid'             => 'required|string|size:8',          //会员UID
                'game_vendor_sign' => 'required|string|max:32',          //游戏厂商标识
                'game_name'        => 'string|max:32',                   //游戏名称
                'report_day'       => 'required|array|size:1',           //日期
                'report_day.*'     => 'required|date|date_format:Y-m-d', //日期
                'pageSize'         => 'integer|between:1,100',           //每页数据条数
               ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['report_day' => 'cast:array'];
    }
}
