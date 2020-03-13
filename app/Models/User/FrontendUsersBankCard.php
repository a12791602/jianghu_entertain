<?php

namespace App\Models\User;

use App\ModelFilters\Finance\SystemPlatformBankFilter;
use App\Models\BaseModel;
use App\Models\Finance\SystemBank;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 用户银行卡
 */
class FrontendUsersBankCard extends BaseModel
{

    /**
     * 状态开启
     */
    public const STATUS_OPEN = 1;

    // 银行卡
    public const TYPE_DEBIT = 1;

    //支付宝
    public const TYPE_ALIPAY = 2;
    public const CODE_ALIPAY = 'ALIPAY';

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array $appends
     */
    protected $appends = ['binding_num'];

    /**
     * @var array
     */
    public static $fieldDefinition = [
                                      'user_id'    => '用户ID',
                                      'mobile'     => '手机号码',
                                      'bank_id'    => '银行名称',
                                      'created_at' => '绑定时间',
                                     ];

    /**
     * Hide the user's bank number. ****
     * @return mixed
     */
    public function getCardNumberHiddenAttribute()
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

    /**
     * 银行信息
     * @return BelongsTo
     */
    public function bank(): BelongsTo
    {
        $bank = $this->belongsTo(SystemBank::class, 'bank_id', 'id');
        return $bank;
    }

    /**
     * 所属会员
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        $user = $this->belongsTo(FrontendUser::class, 'user_id', 'id');
        return $user;
    }

    /**
     * 银行卡绑定次数
     *
     * @return integer
     */
    public function getBindingNumAttribute(): int
    {
        $filterArr = ['card_number' => $this->card_number];
        $count     = self::filter($filterArr, SystemPlatformBankFilter::class)->count();
        return $count;
    }
}
