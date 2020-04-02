<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Statically;

use App\ModelFilters\Activity\SystemStaticActivityFilter;
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
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $inputDatas['platform_id'] = $this->currentPlatformEloq->id;
        $data                      = $this->model::with(['author:id,name', 'lastEditor:id,name'])
            ->filter($inputDatas, SystemStaticActivityFilter::class)->paginate();
        return msgOut($data);
    }
}
