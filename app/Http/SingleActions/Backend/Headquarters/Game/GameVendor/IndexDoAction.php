<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameVendor;

use App\Http\Resources\Backend\Headquarters\Game\GameVendor\GameVendorResource;
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
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData) :JsonResponse
    {
        $outputData = $this->model::with(
            [
             'lastEditor:id,name',
             'author:id,name',
             'gameType:id,name',
             'whiteList:game_vendor_id,ips',
             'icon:id,path',
            ],
        )->filter($inputData)
        ->paginate($this->perPage);
        return msgOut(GameVendorResource::collection($outputData));
    }
}
