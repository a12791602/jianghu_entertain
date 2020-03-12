<?php

namespace App\Http\SingleActions\Common\Sortable;

use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;
use Log;
use Throwable;

/**
 * Class UpdateSortAction
 * @package App\Http\SingleActions\Backend\Merchant\Upload
 */
class UpdateSortAction extends MainAction
{

    /**
     * Update sort order.
     * @param array $item Array.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $item): JsonResponse
    {
        $sorts = $item['sort'];
        $model = $item['model'];
        $sorts = collect($sorts)
            ->pluck('key')
            ->combine(collect($sorts)->pluck('sort')->sort());

        try {
            $models = $model::find($sorts);
            foreach ($models as $model) {
                $column           = data_get($model->sortable, 'order_column_name', 'sort');
                $model->{$column} = $sorts->get($model->getKey());
                $model->save();
            }
            $msgOut = msgOut();
            return $msgOut;
        } catch (Throwable $throwable) {
            Log::error($throwable->getMessage());
        }
        throw new \Exception('300404');
    }
}
