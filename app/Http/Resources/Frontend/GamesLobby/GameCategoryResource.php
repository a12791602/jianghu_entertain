<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use App\Http\Resources\BaseResource;
use App\Models\Game\GameType;
use Illuminate\Http\Request;

/**
 * Class GameCategoryResource
 * @package App\Http\Resources
 */
class GameCategoryResource extends BaseResource
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
