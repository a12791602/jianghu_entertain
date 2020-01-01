<?php

namespace App\Http\Resources\GamesLobby;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class GameCategoryResource
 * @package App\Http\Resources
 */
class GameCategoryResource extends JsonResource
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
            'type_id' => $this->type_id,
            'name' => optional($this->gameType)->name,
        ];
        return $result;
    }
}
