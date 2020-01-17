<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;

/**
 * Class UpdateInformationRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class UpdateInformationRequest extends BaseFormRequest
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
                'pic_path' => 'integer',
                'nickname' => 'string',
               ];
    }
}
