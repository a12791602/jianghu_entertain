<?php

namespace App\Http\Requests\Backend\Merchant\User\UsersTag;

use App\Http\Requests\BaseFormRequest;

/**
 * 用户标签-列表
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
        return ['pageSize' => 'integer|between:1,100']; //每页数据条数
    }
}
