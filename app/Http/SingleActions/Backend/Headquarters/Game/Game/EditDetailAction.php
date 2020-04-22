<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\Game;

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
        $inputDatas['route'] = 'headquarters-api.game.edit-do';
        $data                = backendOperationLog($inputDatas);
        return msgOut($data);
    }
}
