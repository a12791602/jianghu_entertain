<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Offline;

use App\Http\Resources\Backend\Merchant\Finance\Offline\IndexResource;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Offline
 */
class IndexAction extends BaseAction
{

    /**
     * @var mixed
     */
    protected $model;

    /**
     * ***
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;

        $data = $this->model
            ->filter($inputDatas)
            ->paginate($this->perPage);
        return msgOut(IndexResource::collection($data));
    }
}
