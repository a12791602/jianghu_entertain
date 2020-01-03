<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HomePersonalInformationResource
 * @package App\Http\Resources
 */
class HomePersonalInformationResource extends JsonResource
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
            'uid' => $this->uid,
            'pic_path' => $this->pic_path,
            'username' => $this->username,
            'balance' => optional($this->account)->balance,
        ];
        return $result;
    }
}
