<?php

namespace App\Http\SingleActions\Common\Sortable;

use App\Http\Requests\Backend\Headquarters\Sortable\UpdateSortRequest;
use App\Http\SingleActions\MainAction;
use Illuminate\Http\JsonResponse;
use Log;

/**
 * Class UpdateSortAction
 * @package App\Http\SingleActions\Backend\Merchant\Upload
 */
class UpdateSortAction extends MainAction
{

    /**
     * Update sort order.
     * @param UpdateSortRequest $request Sortable UpdateRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(UpdateSortRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $model         = $request->get('model'); // 从 App\Rules\Backend\Common\Sortable\CheckSortableModel 注入
        /**
            [0] => [
                [key]  => 2
                [sort] => 2
            ],
            [1] => [
                [key]  => 1
                [sort] => 1
            ],
            [2] => [
                [key]  => 3
                [sort] => 3
            ],
         */
        $sorts       = $validatedData['sort'];
        $sortCollect = collect($sorts);

        // 与库里的数据进行对比
        if ($sortCollect->count() !== $model::count()) {
            throw new \RuntimeException('304000');
        }
        /**
         * key是要改的顺序, value 是对应的主键资源
         * [
         *  2 => 1,
         *  1 => 2,
         *  3 => 3,
         * ]
         */
        $sortOrder = $sortCollect->pluck('sort')->sort();
        $sortItem  = $sortCollect->pluck('key')->combine($sortOrder);
        try {
            $models = $model::find($sortItem);
            foreach ($models as $model_key => $model) {
                $column           = data_get($model->sortable, 'order_column_name', 'sort');
                $model->{$column} = $sortItem->get($model->getKey());
                if (isset($sortCollect[$model_key]['parent_id'])) {
                    $model->parent_id = $sortCollect[$model_key]['parent_id'];
                }
                $model->save();
            }
            return msgOut();
        } catch (\RuntimeException $exception) {
            Log::error($exception->getMessage());
        }
        throw new \RuntimeException('300404');
    }
}
