<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Marquee;

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
     *
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $pageSize                  = $this->model::getPageSIze();
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $data                      = $this->model::with(['author:id,name', 'lastEditor:id,name'])
            ->filter($inputDatas, NoticeMarqueeFilter::class)->paginate($pageSize);
        return msgOut($data);
    }
}
