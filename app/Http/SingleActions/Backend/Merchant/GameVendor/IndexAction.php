<?php

namespace App\Http\SingleActions\Backend\Merchant\GameVendor;

use App\Http\Resources\Backend\Merchant\GameVendor\IndexResource;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\GameVendor
 */
class IndexAction extends BaseAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['platform_id'] = $this->currentPlatformEloq->id;
        $data                     = $this->model->with('gameVendor', 'icon:id,path')
                                         ->orderByDesc('sort')
                                         ->filter($inputData)
                                         ->withCacheCooldownSeconds(86400)
                                         ->paginate($this->perPage);
        return msgOut(IndexResource::collection($data));
    }
}
