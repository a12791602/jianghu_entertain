<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProfitListResource
 * @package App\Http\Resources\Frontend\GamesLobby
 */
class ProfitListResource extends JsonResource
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
                   'name'    => $this->frontendUser->specificInfo->nickname,
                   'avatar'  => $this->frontendUser->specificInfo->avatar_full,
                   'guid'    => $this->frontendUser->guid,
                   'balance' => $this->balance,
                  ];
        return $result;
    }
}
