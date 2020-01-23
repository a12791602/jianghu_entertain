<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HomePersonalInformationResource
 * @package App\Http\Resources
 */
class PersonalInformationResource extends JsonResource
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
                   'uid'      => $this->uid,
                   'avatar'   => $this->specificInfo->avatar_full,
                   'nickname' => $this->specificInfo->nickname,
                  ];
        return $result;
    }
}
