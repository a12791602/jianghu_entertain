<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Carousel;

use App\ModelFilters\Notice\NoticeCarouselFilter;
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
        $data                      = $this->model
            ->with(
                [
                 'author:id,name',
                 'lastEditor:id,name',
                ],
            )
            ->filter($inputDatas, NoticeCarouselFilter::class)
            ->paginate();
        return msgOut($data);
    }
}
