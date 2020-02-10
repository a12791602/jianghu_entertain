<?php

namespace App\Http\SingleActions\Backend\Headquarters\GameVendor;

use App\ModelFilters\Game\GamesVendorFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\GameVendor
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
    public function execute(array $inputDatas) :JsonResponse
    {
        $pageSize = $this->model::getPageSize();
        $outputDatas = $this->model::with(
            ['lastEditor:id,name', 'author:id,name'],
        )->filter($inputDatas, GamesVendorFilter::class)->paginate($pageSize);
        return msgOut($outputDatas);
    }
}
