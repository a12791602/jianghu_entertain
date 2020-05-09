<?php

namespace App\Http\Resources\Frontend\System;

use App\Http\Resources\BaseResource;

/**
 * Class SystemAvatarResource
 * @package App\Http\Resources\Frontend\System
 */
class SystemAvatarResource extends BaseResource
{

    /**
     * @var integer $id ID.
     */
    private $id;

    /**
     * @var string $avatar_full Avatar_full.
     */
    private $avatar_full;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        return [
                'id'       => $this->id,
                'pic_path' => $this->avatar_full,
               ];
    }
}
