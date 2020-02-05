<?php

namespace App\ModelFilters\Finance;

use EloquentFilter\ModelFilter;

/**
 * Class SystemFinanceOnlineInfoFilter
 * @package App\ModelFilters\Finance
 */
class SystemFinanceOnlineInfoFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * 关联 MerchantAdminUserFilter
     * @var array
     */
    public $relations = [
                         'author'     => ['author_name'],
                         'lastEditor' => ['last_editor_name'],
                        ];

    /**
     * 按平台搜索
     * @param string $platform_sign PlatformSign.
     * @return SystemFinanceOnlineInfoFilter
     */
    public function platformSign(string $platform_sign): SystemFinanceOnlineInfoFilter
    {
        $object = $this->where('platform_sign', $platform_sign);
        return $object;
    }

    /**
     * 按商户号搜索
     * @param string $merchant_code MerchantCode.
     * @return SystemFinanceOnlineInfoFilter
     */
    public function merchantCode(string $merchant_code): SystemFinanceOnlineInfoFilter
    {
        $object = $this->where('merchant_code', $merchant_code);
        return $object;
    }

    /**
     * 按前台名称搜索
     * @param string $frontend_name FrontendName.
     * @return SystemFinanceOnlineInfoFilter
     */
    public function frontendName(string $frontend_name): SystemFinanceOnlineInfoFilter
    {
        $object = $this->where('frontend_name', $frontend_name);
        return $object;
    }

    /**
     * 按商户编号搜索
     * @param string $merchant_no MerchantNo.
     * @return SystemFinanceOnlineInfoFilter
     */
    public function merchantNo(string $merchant_no): SystemFinanceOnlineInfoFilter
    {
        $object = $this->where('merchant_no', $merchant_no);
        return $object;
    }

    /**
     * 按创建时间
     * @param array $crated_at CreatedAt.
     * @return SystemFinanceOnlineInfoFilter
     */
    public function createdAt(array $crated_at): SystemFinanceOnlineInfoFilter
    {
        $object = $this;
        $number = (int) count($crated_at);
        if ($number === 1) {
            $object = $this->where('created_at', '>=', $crated_at[0]);
        } elseif ($number === 2) {
            $object = $this->whereBetween('created_at', $crated_at);
        }
        return $object;
    }

    /**
     * 按更新时间
     * @param array $updated_at UpdatedAt.
     * @return SystemFinanceOnlineInfoFilter
     */
    public function updatedAt(array $updated_at): SystemFinanceOnlineInfoFilter
    {
        $object = $this;
        $number = (int) count($updated_at);
        if ($number === 1) {
            $object = $this->where('updated_at', '>=', $updated_at[0]);
        } elseif ($number === 2) {
            $object = $this->whereBetween('updated_at', $updated_at);
        }
        return $object;
    }
}
