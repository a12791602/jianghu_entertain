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
     * @return array<string,string>|integer|string
     * @throws \Exception Exception.
     */
    public function draw();
}
