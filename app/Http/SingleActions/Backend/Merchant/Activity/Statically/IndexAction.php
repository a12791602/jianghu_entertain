<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Statically;

use App\Http\Resources\Backend\Merchant\Activity\Statically\IndexResource;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class IndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    public $model;

    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $inputData['platform_id'] = $this->currentPlatformEloq->id;
        $data                     = $this->model::with(['author:id,name', 'lastEditor:id,name', 'picture:id,path'])
            ->filter($inputData)->paginate($this->perPage);
        return msgOut(IndexResource::collection($data));
    }
}
