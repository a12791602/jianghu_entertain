<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Login;

use App\ModelFilters\Notice\NoticeLoginFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Login
 */
class IndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    public $model;

    /**
     * ***
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $pageSize                  = $this->model::getPageSize();
        $data                      = $this->model::with(['author:id,name', 'lastEditor:id,name'])
            ->filter($inputDatas, NoticeLoginFilter::class)->paginate($pageSize);
        return msgOut($data);
    }
}
