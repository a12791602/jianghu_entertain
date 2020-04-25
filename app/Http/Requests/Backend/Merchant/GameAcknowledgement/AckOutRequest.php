<?php

namespace App\Http\Requests\Backend\Merchant\GameAcknowledgement;

use App\Http\Requests\BaseFormRequest;

/**
 * Class DoHotRequest
 * @package App\Http\Requests\Backend\Merchant\Game
 */
class AckOutRequest extends BaseFormRequest
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
     * 'data'    => 'required|string|between:218,250',//218-250 not work
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
                'version' => 'required|regex:/(^(\d{1,2}).(\d)$)/',
                'id'      => 'required|exists:system_platforms,sign',
                'data'    => [
                              'required',
                              'regex:/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};\':"\|\\\,.<>\/?]{300,350}$/',//307 開始
                             ],
               ];
    }
}
