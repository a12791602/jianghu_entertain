<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Route;

use App\Http\Requests\BaseFormRequest;

/**
 * 路由-删除
 */
class DeleteRequest extends BaseFormRequest
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
        $rules = ['id' => 'required|exists:system_routes_merchants'];  //ID
        return $rules;
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        $messages = [
                     'id.required' => '缺少路由ID',
                     'id.exists'   => '当前路由不存在',
                    ];
        return $messages;
    }
}
