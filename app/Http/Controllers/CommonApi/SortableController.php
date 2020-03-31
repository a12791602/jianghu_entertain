<?php

namespace App\Http\Controllers\CommonApi;

use App\Http\Requests\Backend\Headquarters\Sortable\UpdateSortRequest;
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
     * @param UpdateSortAction  $action  UpdateSortAction.
     * @param UpdateSortRequest $request UpdateSortRequest.
     * @return JsonResponse
     * @throws \Throwable Throwable.
     */
    public function updateSortable(
        UpdateSortAction $action,
        UpdateSortRequest $request
    ): JsonResponse {
        return $action->execute($request);
    }
}
