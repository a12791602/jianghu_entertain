<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use App\Models\Game\GameType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class GameCategoryResource
 * @package App\Http\Resources
 */
class GameCategoryResource extends JsonResource
{

    /**
     * @var integer $type_id Type_id.
     */
    private $type_id;

    /**
     * @var GameType $gameType GameType Model.
     */
    private $gameType;

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
                'type_id' => $this->type_id,
                'name'    => $this->gameType->name,
               ];
    }
}
