<?php

namespace App\Http\Resources\Frontend\System;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SystemAvatarResource
 * @package App\Http\Resources\Frontend\System
 */
class SystemAvatarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        $result = [
                   'id'       => $this->id,
                   'pic_path' => $this->avatar_full,
                  ];

        return $result;
    }
}
