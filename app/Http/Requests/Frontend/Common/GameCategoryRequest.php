<?php

namespace App\Http\Requests\Frontend\Common;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GameCategoryRequest
 * @package App\Http\Requests\Frontend\Common
 */
class GameCategoryRequest extends FormRequest
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
            'device' => 'integer|required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
            'device.integer' => '设备类型不符合规则',
        ];
    }
}
