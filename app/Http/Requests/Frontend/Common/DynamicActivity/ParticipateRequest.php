<?php

namespace App\Http\Requests\Frontend\Common\DynamicActivity;

use App\Http\Requests\BaseFormRequest;

/**
 * Class ResetPasswordRequest
 * @package App\Http\Requests\Frontend\Common
 */
class ParticipateRequest extends BaseFormRequest
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
        return ['activity_id' => 'required|integer|'];
    }
}
