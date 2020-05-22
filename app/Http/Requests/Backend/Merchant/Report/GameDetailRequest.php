<?php

namespace App\Http\Requests\Backend\Merchant\Report;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\GameReportDay;

/**
 * 游戏报表-详情
 */
class GameDetailRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [GameReportDay::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['project_day' => '起止时间'];
    
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
                'game_vendor_sign' => 'required|alpha|max:32',  //游戏厂商
                'game_name'        => 'string|max:32',          //游戏名称
                'project_day'      => 'array|size:2',           //日期
                'project_day.*'    => 'date|date_format:Y-m-d', //日期
                'pageSize'         => 'integer|between:1,100',  //每页数据条数
               ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['project_day' => 'cast:array'];
    }
}
