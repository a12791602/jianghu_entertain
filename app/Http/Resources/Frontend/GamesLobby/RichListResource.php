<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use App\Http\Resources\BaseResource;
use App\Models\User\FrontendUser;

/**
 * Class RichListResource
 * @package App\Http\Resources
 */
class RichListResource extends BaseResource
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
                'balance' => $this->balance,
               ];
    }
}
