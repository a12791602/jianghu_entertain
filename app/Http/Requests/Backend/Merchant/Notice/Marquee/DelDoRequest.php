<?php

namespace App\Http\Requests\Backend\Merchant\Notice\Marquee;

use App\Http\Requests\BaseFormRequest;

/**
 * Class DelDoRequest
 * @package App\Http\Requests\Backend\Merchant\Notice\Marquee
 */
class DelDoRequest extends BaseFormRequest
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
        return ['id' => 'required|integer|exists:notice_marquees'];
    }
}
