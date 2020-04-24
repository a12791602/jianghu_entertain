<?php

namespace App\Http\SingleActions\Backend\Merchant\Finance\Online;

use App\Http\Resources\Backend\Merchant\Finance\Online\IndexResource;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Finance\Online
 */
class IndexAction extends BaseAction
{

    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['platform_sign'] = $this->currentPlatformEloq->sign;
        $data                        = $this->model->with(
            [
             'channel:id,name,sign',
             'author:id,name',
             'lastEditor:id,name',
             'tags:online_finance_id,tag_id',
            ],
        )->filter($inputDatas)
        ->paginate();
        return msgOut(IndexResource::collection($data));
    }
}
