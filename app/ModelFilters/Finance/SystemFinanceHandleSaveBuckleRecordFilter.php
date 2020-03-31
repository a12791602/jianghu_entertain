<?php

namespace App\ModelFilters\Finance;

use EloquentFilter\ModelFilter;

/**
 * Class SystemFinanceHandleSaveBuckleRecordFilter
 *
 * @package App\ModelFilters\Finance
 */
class SystemFinanceHandleSaveBuckleRecordFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * 关联 FrontendUserFilter
     * @var array
     */
    public $relations = [
                         'user' => [
                                    'mobile',
                                    'guid',
                                    'is_tester',
                                   ],
                        ];

    /**
     * 按资金类型查找.
     *
     * @param  integer $type Type.
     * @return SystemFinanceHandleSaveBuckleRecordFilter
     */
    public function type(int $type): SystemFinanceHandleSaveBuckleRecordFilter
    {
        return $this->where('type', $type);
    }

    /**
     * 按创建时间.
     *
     * @param array $crated_at CreatedAt.
     * @return SystemFinanceHandleSaveBuckleRecordFilter
     */
    public function createdAt(array $crated_at): SystemFinanceHandleSaveBuckleRecordFilter
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
     * 按资金方向搜索.
     *
     * @param integer $direction 资金方向.
     * @return SystemFinanceHandleSaveBuckleRecordFilter
     */
    public function direction(int $direction): SystemFinanceHandleSaveBuckleRecordFilter
    {
        return $this->where('direction', $direction);
    }
}
