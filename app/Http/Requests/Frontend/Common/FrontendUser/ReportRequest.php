<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;

/**
 * Class ReportRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class ReportRequest extends BaseFormRequest
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
                'type'         => 'required|integer|in:1,2,3',     //类型  1.账变明细  2.充值记录 3.提现记录
                'created_at'   => 'array|size:2',                 // 账变时间
                'created_at.*' => 'date|date_format:Y-m-d H:i:s', //账变时间
                'pageSize'     => 'integer|between:1,100',         //每页数据条数
               ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['created_at' => 'cast:array'];
    }
}
