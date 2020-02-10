<?php

namespace App\Models\User;

use App\Models\BaseAuthModel;

/**
 * Class UsersWithdrawOrder
 * @package App\Models\User
 */
class UsersWithdrawOrder extends BaseAuthModel
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * The "booting" method of the model
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(
            static function ($model) {
                $model->order_no = static::availableOrderNo();
                if (!$model->order_no) {
                    return false;
                }
            },
        );
    }

    /**
     * Get available order no.
     * @return string
     * @throws \Exception Exception.
     */
    public static function availableOrderNo(): string
    {
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            $order_no = $prefix . str_pad(strval(random_int(0, 999999)), 6, '0', STR_PAD_LEFT);
            if (!static::query()->where('order_no', $order_no)->exists()) {
                return $order_no;
            }
        }
    }
}
