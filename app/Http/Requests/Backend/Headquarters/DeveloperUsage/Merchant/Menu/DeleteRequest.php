<?php

namespace App\Http\Requests\Backend\Headquarters\DeveloperUsage\Merchant\Menu;

use App\Http\Requests\BaseFormRequest;

/**
 * Class for menu delete request.
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
        $rules = ['id' => 'required|integer|exists:merchant_system_menus'];
        return $rules;
    }

    /**
     * @return mixed[]
     */
    // public function messages(): array
    // {
    //     return [];
    // }
}
