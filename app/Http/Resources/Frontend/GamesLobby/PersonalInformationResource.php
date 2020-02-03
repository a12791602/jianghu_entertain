<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Request;
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
     * @param  Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        $result = [
                   'guid'     => $this->guid,
                   'avatar'   => $this->specificInfo->avatar_full,
                   'nickname' => $this->specificInfo->nickname,
                  ];
        return $result;
    }
}
