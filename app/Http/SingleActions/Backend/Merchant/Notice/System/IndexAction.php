<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\System;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Notice\NoticeSystemFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class IndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    public $model;

    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['platform_id'] = $contll->currentPlatformEloq->id;
        $pageSize                  = $this->model::getPageSize();
        $data                      = $this->model::with(['author:id,name', 'lastEditor:id,name'])
            ->filter($inputDatas, NoticeSystemFilter::class)->paginate($pageSize);
        $msgOut                    = msgOut(true, $data);
        return $msgOut;
    }
}
