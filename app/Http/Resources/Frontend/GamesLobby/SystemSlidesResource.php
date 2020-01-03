<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SystemSlidesResource
 * @package App\Http\Resources\GamesLobby
 */
class SystemSlidesResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'pic_path' => $this->pic_path,
            'redirect_url' => $this->redirect_url,
        ];
        return $result;
    }
}
