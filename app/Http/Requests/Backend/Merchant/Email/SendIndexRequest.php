<?php

namespace App\Http\Requests\Backend\Merchant\Email;

use App\Http\Requests\BaseFormRequest;
use App\Models\Email\SystemEmail;

/**
 * Class SendIndexRequest
 * @package App\Http\Requests\Backend\Merchant\Email
 */
class SendIndexRequest extends BaseFormRequest
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
                'title'        => 'string',
                'name'         => 'string',
                'is_send'      => 'in:' . SystemEmail::IS_SEND_NO . ',' . SystemEmail::IS_SEND_YES,
                'created_at'   => 'array',
                'created_at.*' => 'date',
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
