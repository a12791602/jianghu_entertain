<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Lib\Constant\JHHYCnst;
use App\Models\Game\GamePlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class AssignGamesAction
 * @package App\Http\SingleActions\Backend\Headquarters\Merchant\Platform
 */
class AssignGamesAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data   = [];
        $device = [
                   JHHYCnst::DEVICE_APP,
                   JHHYCnst::DEVICE_H5,
                   JHHYCnst::DEVICE_PC,
                  ];

        foreach ($inputDatas['game_ids'] as $game_id) {
            $tmpData                = [];
            $tmpData['platform_id'] = $inputDatas['platform_id'];
            $tmpData['game_id']     = $game_id;
            foreach ($device as $item) {
                $tmpData['device'] = $item;
                $data[]            = $tmpData;
            }
        }
        try {
            GamePlatform::insert($data);
            return msgOut();
        } catch (\Throwable $exception) {
            throw new \Exception('302000');
        }
    }
}
