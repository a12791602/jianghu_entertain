<?php

namespace App\Http\Requests\Frontend\H5\Recharge;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

/**
 * Class DoHotRequest
 * @package App\Http\Requests\Backend\Merchant\Game
 */
class LoadOnlineRequest extends BaseFormRequest
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
        $order_no = $this->route('order_no');
        $money    = $this->route('money');
        return [
                'platform_sign' => 'required|exists:system_platforms,sign',
                'money'         => 'required|integer',
                'order_no'      => [
                                    'required',
                                    Rule::exists('users_recharge_orders')->where(
                                    static function ($query) use ($order_no, $money): void {
                                        $query->where(
                                            [
                                             [
                                              'order_no',
                                              $order_no,
                                             ],
                                             [
                                              'money',
                                              $money,
                                             ],
                                            ],
                                        );
                                    },
                                 ),
                                   ],
               ];
    }
}
