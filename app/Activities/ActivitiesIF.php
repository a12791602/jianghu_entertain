<?php

namespace App\Activities;

/**
 * 对接活动的契约
 * Interface ActivitiesIF
 * @package App\Game
 */
interface ActivitiesIF
{
    /**
     * @return integer|string
     */
    public function draw();
}
