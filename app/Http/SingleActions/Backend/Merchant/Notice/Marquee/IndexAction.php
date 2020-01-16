<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Notice\NoticeMarqueeFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Marquee
 */
class IndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    protected $model;

    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $pageSize                  = $this->model::getPageSIze();
        $inputDatas['platform_id'] = $contll->currentPlatformEloq->id;
        $data                      = $this->model::with(['author:id,name', 'lastEditor:id,name'])
            ->filter($inputDatas, NoticeMarqueeFilter::class)->paginate($pageSize);
        $msgOut                    = msgOut($data);
        return $msgOut;
    }
}
