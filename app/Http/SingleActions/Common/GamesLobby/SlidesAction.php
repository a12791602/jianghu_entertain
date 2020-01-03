<?php

namespace App\Http\SingleActions\Common\GamesLobby;

use App\Http\Resources\Frontend\GamesLobby\SystemSlidesResource;
use App\ModelFilters\System\SystemFePageBannerFilter;
use App\Models\Systems\SystemFePageBanner;
use Illuminate\Http\JsonResponse;

/**
 * Class SlidesAction
 * @package App\Http\SingleActions\Common\GamesLobby
 */
class SlidesAction
{

    /**
     * Home carousel slides.
     * @param array $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $request): JsonResponse
    {
        $request['status'] = 1;
        $slides            = SystemFePageBanner::filter($request, SystemFePageBannerFilter::class)->get();

        $result = msgOut(true, SystemSlidesResource::collection($slides));
        return $result;
    }
}
