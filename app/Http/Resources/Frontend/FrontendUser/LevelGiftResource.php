<?php

namespace App\Http\Resources\Frontend\FrontendUser;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LevelGiftResource
 * @package App\Http\Resources\Frontend\FrontendUser
 */
class LevelGiftResource extends JsonResource
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
     * @var float $red_packet Red_packet.
     */
    private $red_packet;

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
                'weekly_gift'    => (float) sprintf('%.2f', $this->weekly_gift),
                'promotion_gift' => (float) sprintf('%.2f', $this->promotion_gift),
                'red_packet'     => (float) sprintf('%.2f', $this->red_packet),
                'sign_in'        => 0,
               ];
    }
}
