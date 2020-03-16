<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use App\Http\Requests\Backend\Headquarters\GameType\DelRequest;
use App\Models\Game\Game;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class DelDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class DelDoAction
{
    /**
     * @param DelRequest $request DelRequest.
     * @return JsonResponse
     * @throws \RuntimeException RuntimeException.
     */
    public function execute(DelRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $model     = $request->get('model');// 从 App\Rules\Backend\Common\Sortable\CheckSortableModel 注入
            if (!Game::where('vendor_id', $validated['id'])->get()->isEmpty()) {
                throw new \RuntimeException('300400');
            }
            $model::find($validated['id'])->delete();
            $msgOut = msgOut();
            return $msgOut;
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }
        throw new \RuntimeException('300401');
    }
}
