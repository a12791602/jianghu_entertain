<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\Game;

use App\Models\Systems\SystemLogsBackend;
use Illuminate\Http\JsonResponse;

/**
 * Class EditDetailAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Game
 */
class EditDetailAction extends BaseAction
{

    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['route_name'] = [
                                     'headquarters-api.game.edit-do',
                                     'headquarters-api.game.edit-status',
                                    ];
        $data                     = backendOperationLog(new SystemLogsBackend(), $inputDatas);
        return msgOut($data);
    }
}
