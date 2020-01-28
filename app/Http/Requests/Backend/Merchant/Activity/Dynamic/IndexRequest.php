<?php

namespace App\Http\Requests\Backend\Merchant\Activity\Dynamic;

use App\Http\Requests\BaseFormRequest;

/**
 * Class IndexRequest
 * @package App\Http\Requests\Backend\Merchant\Activity\Dynamic
 */
class IndexRequest extends BaseFormRequest
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
        return ['name' => 'string|min:1|max:16'];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'name.string' => '名称格式错误',
                'name.min'    => '名称最少1个字符',
                'name.max'    => '名称最多16个字符',
               ];
    }
}
