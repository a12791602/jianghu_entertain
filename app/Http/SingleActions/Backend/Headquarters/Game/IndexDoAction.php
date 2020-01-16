<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game;

use App\ModelFilters\Game\GameFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\Game
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
             'type',
             'vendor',
             'lastEditor',
             'author',
            ],
        )->filter($inputDatas, GameFilter::class)->paginate($pageSize);
        $msgOut      = msgOut($outputDatas);
        return $msgOut;
    }
}
