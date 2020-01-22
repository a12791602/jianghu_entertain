<?php

namespace App\Http\Requests\Backend\Headquarters\Email;

use App\Http\Requests\BaseFormRequest;

/**
 * Class ReceivedIndexRequest
 * @package App\Http\Requests\Backend\Headquarters\Email
 */
class ReceivedIndexRequest extends BaseFormRequest
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
                'title'         => 'string',
                'platform_sign' => 'string',
                'created_at'    => 'array',
                'created_at.*'  => 'date',
               ];
    }

    /**
     * @return mixed[]
     */
    public function filters(): array
    {
        return ['created_at' => 'cast:array'];
    }
}
