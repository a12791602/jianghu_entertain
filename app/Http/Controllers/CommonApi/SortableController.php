<?php

namespace App\Http\Controllers\CommonApi;

use App\Http\Requests\Backend\Headquarters\Sortable\Request;
use App\Http\SingleActions\Common\Sortable\UpdateSortAction;
use Illuminate\Http\JsonResponse;

/**
 * Class SortableController
 * @package App\Http\Controllers\CommonApi
 */
class SortableController
{

    /**
     * Drag and drop sortable.
     * @param Request          $request Sortable Request.
     * @param UpdateSortAction $action  UpdateSortAction.
     * @return JsonResponse
     * @throws \Throwable Throwable.
     */
    public function update(Request $request, UpdateSortAction $action): JsonResponse
    {
        $item   = $request->validated();
        $result = $action->execute($item);
        return $result;
    }
}
