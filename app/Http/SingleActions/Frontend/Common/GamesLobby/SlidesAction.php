<?php

namespace App\Http\SingleActions\Frontend\Common\GamesLobby;

use App\Http\Resources\Frontend\GamesLobby\SystemSlidesResource;
use App\JHHYLibs\JHHYCnst;
use App\Models\Notice\NoticeCarousel;
use Illuminate\Http\JsonResponse;

/**
 * Class SlidesAction
 * @package App\Http\SingleActions\Frontend\Common\GamesLobby
 */
class SlidesAction
{

    /**
     * Home carousel slides.
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $criteria = [
                     'status' => JHHYCnst::STATUS_OPEN,
                     'type'   => $inputDatas['flag'],
                     'device' => JHHYCnst::DEVICE_H5,
                    ];
        $slides   = NoticeCarousel::filter($criteria)->get();
        return msgOut(SystemSlidesResource::collection($slides));
    }
}
