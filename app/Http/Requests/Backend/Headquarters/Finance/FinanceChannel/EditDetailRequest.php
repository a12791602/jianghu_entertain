<?php

namespace App\Http\Requests\Backend\Headquarters\Finance\FinanceChannel;

use App\Http\Requests\BaseFormRequest;

/**
 * Class EditDetailRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\FinanceChannel
 */
class EditDetailRequest extends BaseFormRequest
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
                'data_id'      => 'required|exists:games,id',
                'pageSize'     => 'integer|between:1,100',    //每页数据条数
                'created_at'   => 'array|size:2',             //操作时间
                'created_at.*' => 'date',                     //操作时间
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['created_at' => 'cast:array'];
    }
}
