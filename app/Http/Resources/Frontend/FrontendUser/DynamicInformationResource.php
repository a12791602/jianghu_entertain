<?php

namespace App\Http\Resources\Frontend\FrontendUser;

use App\Models\User\FrontendUsersAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

/**
 * Class HomePersonalInformationResource
 * @package App\Http\Resources
 */
class DynamicInformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        $balance    = $this->account->balance;
        $rank_count = FrontendUsersAccount::where('balance', '>', $balance)->count();
        $rank       = 0;
        if ($rank_count < config('games_lobby.rich_rank_within')) {
            $rank = $rank_count + 1;
        }

        $result = [
                   'score'          => 1440,
                   'grade'          => 6,
                   'experience'     => 1500,
                   'weekly_gift'    => $this->specificInfo->weekly_gift,
                   'promotion_gift' => $this->specificInfo->promotion_gift,
                   'balance'        => $this->account->balance,
                   'rich_rank'      => $rank,
                   'profit_rank'    => $rank,
                  ];
        return $result;
    }
}
