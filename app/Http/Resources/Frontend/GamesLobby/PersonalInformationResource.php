<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use App\Models\User\FrontendUsersAccount;
use App\Models\User\FrontendUsersSpecificInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HomePersonalInformationResource
 * @package App\Http\Resources
 */
class PersonalInformationResource extends JsonResource
{

    /**
     * @var integer $guid Guid.
     */
    private $guid;

    /**
     * @var FrontendUsersSpecificInfo $specificInfo SpecificInfo.
     */
    private $specificInfo;

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
                'guid'     => $this->guid,
                'avatar'   => $this->specificInfo->avatar_full,
                'nickname' => $this->specificInfo->nickname,
               ];
    }
}
