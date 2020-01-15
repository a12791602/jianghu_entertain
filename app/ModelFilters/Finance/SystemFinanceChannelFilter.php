<?php

namespace App\ModelFilters\Finance;

use EloquentFilter\ModelFilter;

/**
 * Class SystemFinanceChannelFilter
 *
 * @package App\ModelFilters\Finance
 */
class SystemFinanceChannelFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param  integer $channel_id Channel_id.
     * @return SystemFinanceChannelFilter
     */
    public function channel(int $channel_id): SystemFinanceChannelFilter
    {
        $object = $this->where('id', $channel_id);
        return $object;
    }

    /**
     * @param  integer $type_id Type_id.
     * @return SystemFinanceChannelFilter
     */
    public function type(int $type_id): SystemFinanceChannelFilter
    {
        $object = $this->where('type_id', $type_id);
        return $object;
    }

    /**
     * @param  integer $vendor_id Vendor_id.
     * @return SystemFinanceChannelFilter
     */
    public function vendor(int $vendor_id): SystemFinanceChannelFilter
    {
        $object = $this->where('vendor_id', $vendor_id);
        return $object;
    }
}
