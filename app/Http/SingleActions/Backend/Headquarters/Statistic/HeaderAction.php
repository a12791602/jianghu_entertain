<?php

namespace App\Http\SingleActions\Backend\Headquarters\Statistic;

use App\Models\User\FrontendUser;
use Illuminate\Http\JsonResponse;

/**
 * Class HeaderAction
 * @package App\Http\SingleActions\Backend\Headquarters\Statistic
 */
class HeaderAction
{
    /**
     * Headquarters Homepage Statistics.
     * @return JsonResponse
     */
    public function execute(): JsonResponse
    {
        $statistics = FrontendUser::where('is_online', FrontendUser::IS_ONLINE_YES)->count();

        $item = [
                 'online'   => $statistics,
                 'activity' => $statistics,
                ];
        return msgOut($item);
    }
}
