<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game;

use App\Models\Platform\GamePlatform;
use DB;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class DelDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Game
 */
class DelDoAction extends BaseAction
{
    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception|\RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        try {
            DB::beginTransaction();
            GamePlatform::where('game_id', $inputDatas['id'])->delete();
            $this->model->where('id', $inputDatas['id'])->delete();
            DB::commit();
            $msgOut = msgOut();
            return $msgOut;
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
        DB::rollBack();
        throw new \RuntimeException('300202');
    }
}
