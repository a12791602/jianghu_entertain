<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameVendor;

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
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $outputDatas = $this->model::with(
            [
             'lastEditor:id,name',
             'author:id,name',
             'gameType:id,name',
             'whiteList:game_vendor_id,ips',
            ],
        )->filter($inputDatas)
        ->paginate();
        return msgOut($outputDatas);
    }
}
