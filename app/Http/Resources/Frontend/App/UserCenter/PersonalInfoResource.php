<?php

namespace App\Http\Resources\Frontend\App\UserCenter;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HomePersonalInformationResource
 * @package App\Http\Resources
 */
class PersonalInfoResource extends JsonResource
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
                   'guid'      => $this->guid,
                   'avatar'    => $this->specificInfo->avatar_full,
                   'avatar_id' => $this->specificInfo->avatar,
                   'nickname'  => $this->specificInfo->nickname,
                  ];
        return $result;
    }
}
