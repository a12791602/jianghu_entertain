<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameType;

use App\Http\Requests\Backend\Headquarters\Game\GameType\EditDoRequest;
use Arr;
use Illuminate\Http\JsonResponse;

/**
 * Class EditDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class EditDoAction
{

    /**
     * @param EditDoRequest $request EditDoRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(EditDoRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $model     = $request->get('model');// 从 App\Rules\Backend\Common\Sortable\CheckSortableModel 注入
        $item      = $model::find($validated['id']);
        $item->fill(Arr::only($validated, ['id', 'name', 'sign']));
        if (!$item->save()) {
            throw new \RuntimeException('300403');
        }
        return msgOut();
    }
}
