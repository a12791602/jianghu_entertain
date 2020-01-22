<?php

namespace App\ModelFilters\Email;

use EloquentFilter\ModelFilter;

/**
 * Class SystemEmailOfHeadFilter
 *
 * @package App\ModelFilters\Email
 */
class SystemEmailOfHeadFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['email' => ['platform_sign']];

    /**
     * 按创建时间
     * @param array $crated_at CreatedAt.
     * @return SystemEmailOfHeadFilter
     */
    public function createdAt(array $crated_at): SystemEmailOfHeadFilter
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
}
