<?php

namespace App\Http\Requests\Backend\Headquarters\Report;

use App\Http\Requests\BaseFormRequest;

/**
 * 厅主充提报表
 */
class PlatformAccountRequest extends BaseFormRequest
{

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [
                                  'platform_name' => '站点名称',
                                  'report_day'    => '时间',
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
                'platform_name' => 'string|max:32',          //站点名称
                'report_day'    => 'array|size:2',           //时间
                'report_day.*'  => 'date|date_format:Y-m-d', //时间
                'pageSize'      => 'integer|between:1,100',  //每页数据条数
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['report_day' => 'cast:array'];
    }
}
