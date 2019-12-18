<?php

namespace App\ModelFilters\Game;

use EloquentFilter\ModelFilter;

/**
 * Class GameVendorPlatformFilter
 * @package App\ModelFilters\Game
 */
class GameVendorPlatformFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [
        'gameVendor' => ['name'],
    ];
    /**
     * @param  integer $status Status.
     * @return object
     */
    public function status(int $status): object
    {
        $object = $this->where('status', $status);
        return $object;
    }

    /**
     * @param  integer $platform_id PlatformId.
     * @return object
     */
    public function platform(int $platform_id): object
    {
        $object = $this->where('platform_id', $platform_id);
        return $object;
    }

    /**
     * @param integer $device Device.
     * @return object
     */
    public function device(int $device): object
    {
        $object = $this->where('device', $device);
        return $object;
    }
}
