<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameType;

use App\ModelFilters\Game\GamesTypeFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class IndexDoAction extends BaseAction
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
        $outputDatas = $this->model::with(
            [
             'lastEditor',
             'author',
            ],
        )->filter($inputDatas, GamesTypeFilter::class)->paginate($pageSize);
        $msgOut      = msgOut(true, $outputDatas);
        return $msgOut;
    }
}
