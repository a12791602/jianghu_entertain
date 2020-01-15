<?php

namespace App\Http\Requests\Backend\Headquarters\Setting\LoginLog;

use App\Http\Requests\BaseFormRequest;

/**
 * 管理员登录日志
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
                'email'    => 'email:rfc,dns',
                'name'     => 'string',
                'ip'       => 'ip',
                'createAt' => 'string',
               ];
    }

    // /**
    //  * @return array
    //  */
    // public function messages(): array
    // {
    //     return [

    //     ];
    // }
}
