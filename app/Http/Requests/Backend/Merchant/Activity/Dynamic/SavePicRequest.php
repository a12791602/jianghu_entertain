<?php

namespace App\Http\Requests\Backend\Merchant\Activity\Dynamic;

use App\Http\Requests\BaseFormRequest;

/**
 * Class SavePicRequest
 * @package App\Http\Requests\Backend\Merchant\Activity\Dynamic
 */
class SavePicRequest extends BaseFormRequest
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
                'id'      => 'required|exists:system_dyn_activity_platforms,id',
                'pc_pic'  => 'string|min:1|max:128',
                'h5_pic'  => 'string|min:1|max:128',
                'app_pic' => 'string|min:1|max:128',
               ];
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
