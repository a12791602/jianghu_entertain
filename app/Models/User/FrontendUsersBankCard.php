<?php

namespace App\Models\User;

use App\Models\BaseModel;

/**
 * 用户银行卡
 */
class FrontendUsersBankCard extends BaseModel
{

    /**
     * 状态开启
     */
    public const STATUS_OPEN = 1;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * Hide the user's bank number. ****
     * @return string
     */
    public function getCardNumberHiddenAttribute(): string
    {
        if ($this->type === 1) {
            // User's bank card.
            $result = substr_replace($this->card_number, ' **** **** ', 4, 12);
        } else {
            // User's AliPay.
            $result = substr_replace($this->card_number, ' **** ', 3, 4);
        }
        return $result;
    }
}
