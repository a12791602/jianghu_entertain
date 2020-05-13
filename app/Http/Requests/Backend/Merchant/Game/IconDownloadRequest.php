<?php

namespace App\Http\Requests\Backend\Merchant\Game;

use App\Http\Requests\BaseFormRequest;

/**
 * Class IconDownloadRequest
 * @package App\Http\Requests\Backend\Merchant\Game
 */
class IconDownloadRequest extends BaseFormRequest
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
        return ['icon_id' => 'required|integer|exists:static_resources,id'];
    }
}
