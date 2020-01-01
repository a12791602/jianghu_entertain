<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class GameListResource
 * @package App\Http\Resources
 */
class GameListResource extends JsonResource
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
            'type_id' => optional($this->games)->type_id,
            'name' => optional($this->games)->name,
        ];
        return $result;
    }
}
