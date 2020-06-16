<?php

namespace App\Http\Resources\Frontend\FrontendUser;

use App\Http\Resources\BaseResource;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccount;
use App\Models\User\FrontendUsersSpecificInfo;
use Illuminate\Http\Request;

/**
 * Class HomePersonalInformationResource
 * @package App\Http\Resources
 */
class DynamicInformationResource extends BaseResource
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
     * @var string $fund_password Account.
     */
    private $fund_password;

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
        $fund_password = $this->fund_password ? FrontendUser::FUND_PASSWORD_SET : FrontendUser::FUND_PASSWORD_UNSET;
        return [
                'score'         => 1440,
                'level'         => $this->specificInfo->level,
                'experience'    => $this->specificInfo->experience,
                'balance'       => (float) sprintf('%.2f', $this->account->balance),
                'rich_rank'     => $rank,
                'profit_rank'   => $rank,
                'fund_password' => $fund_password,
               ];
    }
}
