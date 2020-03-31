<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameType;

use App\Http\Requests\Backend\Headquarters\Game\GameType\DelDoRequest;
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
     * @param DelDoRequest $request DelDoRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(DelDoRequest $request): JsonResponse
    {
        $validated     = $request->validated();
        $model         = $request->get('model');// 从 App\Rules\Backend\Common\Sortable\CheckSortableModel 注入
        $categoryModel = $model::where('id', $validated['id'])->first();

        if (!$categoryModel) {
            throw new \RuntimeException('300405');
        }
        if ($categoryModel->games()->exists()) {
            throw new \RuntimeException('300400');
        }
        try {
            $model::find($validated['id'])->delete();
            return msgOut();
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }
        throw new \RuntimeException('300401');
    }
}
