<?php

namespace App\Http\Resources\Frontend\FrontendUser;

use App\Models\User\FrontendUsersAccount;
use App\Models\User\FrontendUsersSpecificInfo;
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
     * @var FrontendUsersAccount $account Account.
     */
    private $account;

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
        $balance    = $this->account->balance;
        $rank_count = FrontendUsersAccount::where('balance', '>', $balance)->count();
        $rank       = 0;
        if ($rank_count < config('games_lobby.rich_rank_within')) {
            $rank = $rank_count + 1;
        }
        return [
                'score'       => 1440,
                'level'       => $this->specificInfo->level,
                'experience'  => $this->specificInfo->experience,
                'balance'     => $this->account->balance,
                'rich_rank'   => $rank,
                'profit_rank' => $rank,
               ];
    }
}
