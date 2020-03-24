<?php

namespace App\Http\SingleActions\Backend\Headquarters\Activity\SystemDynActivity;

use App\ModelFilters\Activity\SystemDynActivityFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Headquarters\Activity\SystemDynActivity
 */
class IndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    protected $model;
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $pageSize    = $this->model::getPageSize();
        $outputDatas = $this->model::with('lastEditor:id,name')
            ->filter($inputDatas, SystemDynActivityFilter::class)->paginate($pageSize);
        $msgOut      = msgOut($outputDatas);
        return $msgOut;
    }
}
