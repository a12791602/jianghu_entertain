<?php

namespace App\Game;

use App\Activities\ActivitiesIF;
use App\Models\Activity\ActivitiesDynSystem;

/**
 * Class Base
 * @package App\Game\Core
 */
abstract class BaseActivity implements ActivitiesIF
{

    /**
     * @var ActivitiesDynSystem ActivitiesDynSystem Model.
     */
    protected $activity;

    /**
     * BaseActivity constructor.
     * @param ActivitiesDynSystem $activity ActivitiesDynSystem Model.
     */
    public function __construct(ActivitiesDynSystem $activity)
    {
        $this->activity = $activity;
    }

    /**
     * @param object $acConfigInstance 获取对应游戏的奖品拥有的model.
     * @param array  $acConfig         奖品配置数组.
     * @return float
     */
    protected function getPrice(object $acConfigInstance, array $acConfig): float
    {
        $item     = getItemByProb($acConfig);
        $itemEloq = $acConfigInstance->where('item', $item)->first();
        return $itemEloq->amount ?? 0.0;
    }
}
