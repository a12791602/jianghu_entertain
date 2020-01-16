<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use App\Models\Game\Game;
use Illuminate\Http\JsonResponse;

/**
 * Class DelDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class DelDoAction extends BaseAction
{
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (!Game::where('vendor_id', $inputDatas['id'])->get()->isEmpty()) {
            throw new \Exception('300400');
        }
        if ($this->model->where('id', $inputDatas['id'])->delete()) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('300401');
    }
}
