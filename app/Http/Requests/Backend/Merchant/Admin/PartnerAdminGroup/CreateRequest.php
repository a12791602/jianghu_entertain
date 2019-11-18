<?php

namespace App\Http\Requests\Backend\Merchant\Admin\PartnerAdminGroup;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for partner admin group create request.
 */
class CreateRequest extends BaseFormRequest
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
            'group_name' => 'required|string',
            'role' => 'required',
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
