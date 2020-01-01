<?php

namespace App\ModelFilters\System;

use EloquentFilter\ModelFilter;

/**
 * 用户银行卡
 */
class FrontendUsersBankCardFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * ID
     *
     * @param  integer $dataId ID.
     * @return $this
     */
    public function dataId(int $dataId)
    {
        $eloq = $this->where('id', $dataId);
        return $eloq;
    }
    
    /**
     * 用户UID
     *
     * @param  integer $uniqid 用户UID.
     * @return $this
     */
    public function uniqid(int $uniqid)
    {
        $eloq = $this->where('uid', $uniqid);
        return $eloq;
    }

    /**
     * 用户手机号
     *
     * @param  integer $mobile 用户手机号.
     * @return $this
     */
    public function mobile(int $mobile)
    {
        $eloq = $this->where('mobile', $mobile);
        return $eloq;
    }

    /**
     * 银行ID
     *
     * @param  integer $bankId 银行ID.
     * @return $this
     */
    public function bankId(int $bankId)
    {
        $eloq = $this->where('bank_id', $bankId);
        return $eloq;
    }

    /**
     * 平台标识
     *
     * @param  string $sign 平台标识.
     * @return $this
     */
    public function sign(string $sign)
    {
        $eloq = $this->where('platform_sign', $sign);
        return $eloq;
    }

    /**
     * 绑定时间
     *
     * @param  string $createdStr 绑定时间.
     * @return $this
     */
    public function createdAt(string $createdStr)
    {
        $createdArr = json_decode($createdStr, true);
        if (!is_array($createdArr) || count($createdArr) !== 2) {
            $eloq = $this;
        } else {
            $eloq = $this->whereBetween('created_at', $createdArr);
        }
        return $eloq;
    }
}
