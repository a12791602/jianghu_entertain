<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

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
        $appEnvironment = App::environment();
        $result         = [
                           'uid'        => $this->uid,
                           'pic_path'   => config('image_domain.' . $appEnvironment) . $this->pic_path,
                           'username'   => $this->username,
                           'level_deep' => $this->level_deep,
                           'balance'    => optional($this->account)->balance,
                          ];
        return $result;
    }
}
