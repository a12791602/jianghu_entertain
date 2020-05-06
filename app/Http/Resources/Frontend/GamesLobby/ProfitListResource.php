<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use App\Models\User\FrontendUser;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProfitListResource
 * @package App\Http\Resources\Frontend\GamesLobby
 */
class ProfitListResource extends JsonResource
{

    /**
     * @var FrontendUser $frontendUser FrontendUser.
     */
    private $frontendUser;

    /**
     * @var float $balance Balance.
     */
    private $balance;

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
                'name'    => optional($this->frontendUser->specificInfo)->nickname,
                'avatar'  => optional($this->frontendUser->specificInfo)->avatar_full,
                'guid'    => $this->frontendUser->guid,
                'balance' => (float) sprintf('%.2f', $this->balance),
               ];
    }
}
