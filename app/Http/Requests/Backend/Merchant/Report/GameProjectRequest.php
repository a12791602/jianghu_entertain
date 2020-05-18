<?php

namespace App\Http\Requests\Backend\Merchant\Report;

use App\Http\Requests\BaseFormRequest;
use App\Models\Game\GameProject;
use App\Models\User\FrontendUser;

/**
 * 平台注单-列表
 */
class GameProjectRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [
                                  GameProject::class,
                                  FrontendUser::class,
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
                'mobile'              => 'string|regex:/^1[345789]\d{9}$/', //会员账号(手机号码第一位1第二位345789总共11位数字)
                'guid'                => 'string|max:16',                   //会员UID
                'serial_number'       => 'alpha_num|max:32',                //注单号
                'status'              => 'integer|in:0,1,2,3,4',            //状态 0已投注 1已撤销 2未中奖 3已中奖 4已派奖
                'game_vendor_sign'    => 'alpha|max:32',                    //游戏厂商
                'their_create_time'   => 'array|size:2',                    //注单时间
                'their_create_time.*' => 'date|date_format:Y-m-d H:i:s',    //注单时间
                'delivery_time'       => 'array|size:2',                    //派彩时间
                'delivery_time.*'     => 'date|date_format:Y-m-d H:i:s',    //派彩时间
                'created_at'          => 'array|size:2',                    //入库时间
                'created_at.*'        => 'date|date_format:Y-m-d H:i:s',    //入库时间
                'pageSize'            => 'integer|between:1,100',           //每页数据条数
               ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return mixed[]
     */
    public function filters(): array
    {
        return [
                'their_create_time' => 'cast:array',
                'delivery_time'     => 'cast:array',
                'created_at'        => 'cast:array',
               ];
    }
}
