<?php

namespace App\Http\Requests\Backend\Headquarters\Merchant\Platform;

use App\Http\Requests\BaseFormRequest;

/**
 * Class AssignedGamesRequest
 *
 * @package App\Http\Requests\Backend\Headquarters\Merchant\Platform
 */
class AssignedGamesRequest extends BaseFormRequest
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
                'platform_sign' => 'required|exists:system_platforms,sign',
                'vendor_id'     => 'exists:games_vendors,id',
                'game_id'       => 'exists:games,id',
               ];
    }

    /**
     * @return mixed[]
     */
    public function messages(): array
    {
        return [
                'platform_sign.required' => '请选择平台',
                'platform_sign.exists'   => '所选择平台不存在',
                'vendor_id.exists'       => '所选厂商不存在',
                'game_id.exists'         => '所选游戏不存在',
               ];
    }
}
