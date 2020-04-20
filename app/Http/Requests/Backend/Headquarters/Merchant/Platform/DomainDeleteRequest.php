<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 *  Class for domain delete request.
 */
class DomainDeleteRequest extends BaseFormRequest
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
     * Get the validation rules that apply to the request .
     *
     * @return mixed[]
     */
    public function rules(): array
    {
        return ['id' => 'required|integer|exists:system_domains'];
    }
}
