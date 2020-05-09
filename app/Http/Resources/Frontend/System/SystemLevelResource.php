<?php

namespace App\Http\Resources\Frontend\System;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * Class SystemLevelResource
 * @package App\Http\Resources\Frontend\FrontendUser
 */
class SystemLevelResource extends BaseResource
{

    /**
     * @var integer $level Level.
     */
    private $level;

    /**
     * @var float $weekly_gift Weekly_gift.
     */
    private $weekly_gift;

    /**
     * @var float $promotion_gift Promotion_gift.
     */
    private $promotion_gift;

    /**
     * @var integer $experience_min Experience_min.
     */
    private $experience_min;

    /**
     * @var integer $experience_max Experience_max.
     */
    private $experience_max;

    /**
     * Transform the resource into an array.
     *
     * @param  Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        return [
                'level'          => $this->level,
                'experience_min' => $this->experience_min,
                'experience_max' => $this->experience_max,
                'promotion_gift' => (float) sprintf('%.2f', $this->promotion_gift),
                'weekly_gift'    => (float) sprintf('%.2f', $this->weekly_gift),
               ];
    }
}
