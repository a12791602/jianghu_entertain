<?php

namespace App\ModelFilters\Finance;

use EloquentFilter\ModelFilter;

/**
 * Class SystemFinanceOfflineInfoFilter
 * @package App\ModelFilters\Finance
 */
class SystemFinanceOfflineInfoFilter extends ModelFilter
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
     * 按名称搜索
     * @param string $name Name.
     * @return SystemFinanceOfflineInfoFilter
     */
    public function name(string $name): SystemFinanceOfflineInfoFilter
    {
        $object = $this->where('name', $name);
        return $object;
    }

    /**
     * 按卡号搜索
     * @param string $account Account.
     * @return SystemFinanceOfflineInfoFilter
     */
    public function account(string $account): SystemFinanceOfflineInfoFilter
    {
        $object = $this->where('account', $account);
        return $object;
    }

    /**
     * 按户名搜索
     * @param string $username Username.
     * @return SystemFinanceOfflineInfoFilter
     */
    public function username(string $username): SystemFinanceOfflineInfoFilter
    {
        $object = $this->where('username', $username);
        return $object;
    }

    /**
     * 按创建时间
     * @param array $crated_at CreatedAt.
     * @return SystemFinanceOfflineInfoFilter
     */
    public function createdAt(array $crated_at): SystemFinanceOfflineInfoFilter
    {
        $object = null;
        $number = (int) count($crated_at);
        if ($number === 1) {
            $object = $this->where('created_at', '>=', $crated_at[0]);
        } elseif ($number === 2) {
            $object = $this
                ->where('created_at', '>=', $crated_at[0])
                ->where('created_at', '<=', $crated_at[1]);
        } else {
            $object = $this;
        }
        return $object;
    }

    /**
     * 按更新时间
     * @param array $updated_at UpdatedAt.
     * @return SystemFinanceOfflineInfoFilter
     */
    public function updatedAt(array $updated_at): SystemFinanceOfflineInfoFilter
    {
        $object = null;
        $number = (int) count($updated_at);
        if ($number === 1) {
            $object = $this->where('updated_at', '>=', $updated_at[0]);
        } elseif ($number === 2) {
            $object = $this
                ->where('updated_at', '>=', $updated_at[0])
                ->where('updated_at', '<=', $updated_at[1]);
        } else {
            $object = $this;
        }
        return $object;
    }

    /**
     * 按入款类型.
     *
     * @param integer $type_id 类型id.
     * @return SystemFinanceOfflineInfoFilter
     */
    public function type(int $type_id): SystemFinanceOfflineInfoFilter
    {
        $object = $this->where('type_id', $type_id);
        return $object;
    }
}
