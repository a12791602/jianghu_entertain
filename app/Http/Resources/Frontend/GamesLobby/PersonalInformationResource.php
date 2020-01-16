<?php

namespace App\Http\Resources\Frontend\GamesLobby;

use App\Models\User\FrontendUsersAccount;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

/**
 * Class HomePersonalInformationResource
 * @package App\Http\Resources
 */
class PersonalInformationResource extends JsonResource
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
        $balance        = $request->user()->account->balance;
        $rank           = FrontendUsersAccount::where('balance', '>', $balance)->count();
        $result         = [
                           'uid'        => $this->uid,
                           'pic_path'   => config('image_domain.' . $appEnvironment) . $this->pic_path,
                           'username'   => $this->username,
                           'level_deep' => $this->level_deep,
                           'balance'    => optional($this->account)->balance,
                           'rich_rank'  => $rank + 1,
                          ];

        return $result;
    }
}
