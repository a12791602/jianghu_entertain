<?php

namespace App\Http\Requests\Frontend\Common\FrontendUser;

use App\Http\Requests\BaseFormRequest;

/**
 * Class InformationUpdateRequest
 * @package App\Http\Requests\Frontend\Common\FrontendUser
 */
class InformationUpdateRequest extends BaseFormRequest
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
                'avatar'   => 'integer',
                'nickname' => [
                               'string',
                               'min:2',
                               'max:5',
                               'regex:/^[\x{4e00}-\x{9fa5}].{1,5}$/u', //(1-5位中文)
                              ],
               ];
    }

    /**
     * Get custom messages for validator errors.
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'nickname.min'   => '昵称最少两个字',
                'nickname.max'   => '昵称最多五个字',
                'nickname.regex' => '昵称包含特殊字符',
               ];
    }
}
