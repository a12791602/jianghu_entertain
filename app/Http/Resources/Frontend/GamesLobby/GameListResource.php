<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class GameListResource
 * @package App\Http\Resources
 */
class GameListResource extends JsonResource
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
                   'game_id'   => optional($this->games)->id,
                   'name'      => optional($this->games)->name,
                   'game_sign' => optional($this->games)->sign,
                   'type_id'   => optional($this->games)->type_id,
                   'type_sign' => optional($this->games)->type->sign,
                  ];
        return $result;
    }
}
