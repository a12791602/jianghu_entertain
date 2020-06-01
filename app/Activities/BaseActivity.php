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
}
