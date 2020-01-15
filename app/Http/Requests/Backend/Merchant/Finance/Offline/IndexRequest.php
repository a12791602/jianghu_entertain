<?php

namespace App\Http\Requests\Backend\Merchant\Finance\Offline;

use App\Http\Requests\BaseFormRequest;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Finance\Offline
 */
class IndexRequest extends BaseFormRequest
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
                'name'             => 'string',
                'account'          => 'string',
                'username'         => 'string',
                'author_name'      => 'string',
                'created_at'       => 'array',
                'created_at.*'     => 'date',
                'last_editor_name' => 'string',
                'updated_at'       => 'array',
                'updated_at.*'     => 'date',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'created_at.array'  => '添加时间格式不正确',
                'created_at.*.date' => '添加时间格式必须是时间类型',
                'updated_at.array'  => '更新时间格式不正确',
                'updated_at.*.date' => '更新时间格式必须是时间类型',
               ];
    }
    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return [
                'created_at' => 'cast:array',
                'updated_at' => 'cast:array',
               ];
    }
}
