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
        $outputDatas = $this->model::filter($inputDatas, GamesVendorFilter::class)->get();
        return msgOut(true, $outputDatas, '200', '获取成功');
    }
}
