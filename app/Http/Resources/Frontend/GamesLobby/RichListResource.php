<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RichListResource
 * @package App\Http\Resources
 */
class RichListResource extends JsonResource
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
                   'mobile'  => optional($this->frontendUser)->mobile_hidden,
                   'balance' => $this->balance,
                  ];
        return $result;
    }
}
