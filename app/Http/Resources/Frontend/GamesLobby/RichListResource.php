<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RichListResource
 * @package App\Http\Resources
 */
class RichListResource extends JsonResource
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
                   'name'    => optional($this->frontendUser->specificInfo)->nickname,
                   'guid'    => $this->frontendUser->guid,
                   'balance' => $this->balance,
                  ];
        return $result;
    }
}
