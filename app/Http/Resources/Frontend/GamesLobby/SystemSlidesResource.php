<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

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
        $appEnvironment = App::environment();
        $result         = [
                           'title'        => $this->title,
                           'pic_path'     => config('image_domain.' . $appEnvironment)  . $this->pic_path,
                           'redirect_url' => $this->redirect_url,
                           'type'         => $this->type,
                          ];
        return $result;
    }
}
