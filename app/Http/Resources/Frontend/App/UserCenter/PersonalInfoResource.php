<?php

namespace App\Http\Resources\Frontend\App\UserCenter;

use App\Models\User\FrontendUsersSpecificInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HomePersonalInformationResource
 * @package App\Http\Resources
 */
class PersonalInfoResource extends JsonResource
{

    /**
     * @var integer $guid  Guid.
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
                'guid'      => $this->guid,
                'avatar'    => $this->specificInfo->avatar_full,
                'avatar_id' => $this->specificInfo->avatar,
                'nickname'  => $this->specificInfo->nickname,
               ];
    }
}
