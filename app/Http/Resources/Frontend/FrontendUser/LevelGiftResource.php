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
     * Transform the resource into an array.
     *
     * @param  Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        $result = [
                   'level'          => $this->level,
                   'weekly_gift'    => $this->weekly_gift,
                   'promotion_gift' => $this->promotion_gift,
                   'red_packet'     => $this->red_packet,
                   'sign_in'        => $this->sign_in,
                  ];
        return $result;
    }
}
