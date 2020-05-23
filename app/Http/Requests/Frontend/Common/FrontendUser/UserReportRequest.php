<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;

/**
 * Class UserReportRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class UserReportRequest extends BaseFormRequest
{
    
    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = ['report_day' => '起止日期'];

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
                'report_day'   => 'required|array|size:2',           //日期
                'report_day.*' => 'required|date|date_format:Y-m-d', //日期
                'pageSize'     => 'integer|between:1,100',           //每页数据条数
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
