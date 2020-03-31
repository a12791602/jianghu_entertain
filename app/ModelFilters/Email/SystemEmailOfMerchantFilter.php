<?php

namespace App\ModelFilters\Email;

use EloquentFilter\ModelFilter;

/**
 * Class SystemEmailOfMerchantFilter
 *
 * @package App\ModelFilters\Email
 */
class SystemEmailOfMerchantFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['email' => ['title']];

    /**
     * 按创建时间
     * @param array $crated_at CreatedAt.
     * @return SystemEmailOfMerchantFilter
     */
    public function createdAt(array $crated_at): SystemEmailOfMerchantFilter
    {
        $object = $this;
        $number = (int) count($crated_at);
        if ($number === 1) {
            $object = $this->where('created_at', '>=', $crated_at[0]);
        } elseif ($number === 2) {
            $object = $this
                ->where('created_at', '>=', $crated_at[0])
                ->where('created_at', '<=', $crated_at[1]);
        }
        return $object;
    }

    /**
     * 按平台搜索.
     *
     * @param string $platform_sign 平台标记.
     * @return SystemEmailOfMerchantFilter
     */
    public function platformSign(string $platform_sign): SystemEmailOfMerchantFilter
    {
        return $this->where('platform_sign', $platform_sign);
    }
}
