<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;
use App\Models\Systems\SystemPlatform;

/**
 *  Class for do edit request.
 */
class EditRequest extends BaseFormRequest
{

    /**
     * @var array 需要依赖模型中的字段备注信息
     */
    protected $dependentModels = [SystemPlatform::class];

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'role'       => '权限',
                                  'type'       => '短信操作方式',
                                  'sms_num'    => '短信操作数量',
                                  'start_time' => '开始时间',
                                  'end_time'   => '结束时间',
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
                'id'            => 'required|exists:system_platforms', //ID
                'agency_method' => 'required|string',                  //代理方式
                'pc_skin_id'    => 'required|integer',                 //PC皮肤
                'h5_skin_id'    => 'required|integer',                 //H5皮肤
                'app_skin_id'   => 'required|integer',                 //APP皮肤
                'role'          => 'required|string',                  //权限
                'type'          => 'in:0,1',                           //短信操作方式  0减少  1增加
                'sms_num'       => 'integer|gte:0',                    //操作短信数量
                'start_time'    => 'required|date_format:Y-m-d H:i:s', //开始时间
                'end_time'      => 'required|date_format:Y-m-d H:i:s', //结束时间
               ];
    }
}
