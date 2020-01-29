<?php

namespace App\Http\Requests\Backend\Headquarters\Email;

use App\Http\Requests\BaseFormRequest;

/**
 * Class ReadEmailRequest
 * @package App\Http\Requests\Backend\Headquarters\Email
 */
class ReadEmailRequest extends BaseFormRequest
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
        return ['id' => 'required|exists:system_email_of_heads,id'];
    }
}
