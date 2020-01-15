<?php

namespace App\Http\Requests\Backend\Headquarters\GameType;

use App\Http\Requests\BaseFormRequest;

/**
 * Class DelRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\GameType
 */
class DelRequest extends BaseFormRequest
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
        return ['id' => 'required|exists:games_types,id'];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'id.required' => 'ID不存在',
                'id.exists'   => 'ID不存在',
               ];
    }
}
