<?php

namespace App\Http\Requests\Backend\Merchant\System\Config;

use App\Http\Requests\BaseFormRequest;

/**
 * 全域设置-编辑
 */
class EditRequest extends BaseFormRequest
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
                'sign'  => 'required|string|max:32',   //标识
                'key'   => 'required|in:value,status', //表字段名
                'value' => 'required|string',          //表字段值
               ];
    }
}
