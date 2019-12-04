<?php

namespace App\Http\Requests\Backend\Headquarters\Admin\BackendAdminGroup;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for destroy request.
 */
class DestroyRequest extends BaseFormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|numeric|exists:backend_admin_access_groups,id',
            'group_name' => 'required|exists:backend_admin_access_groups,group_name',
        ];
    }

    /*public function messages()
{
return [
'lottery_sign.required' => 'lottery_sign is required!',
'trace_issues.required' => 'trace_issues is required!',
'balls.required' => 'balls is required!'
];
}*/
}