<?php

namespace App\Http\SingleActions\Backend\Merchant\GameVendor;

use App\ModelFilters\Game\GameVendorPlatformFilter;
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
        $datas                     = $this->model->with('gameVendor')
                                          ->orderByDesc('sort')
                                          ->filter($inputDatas, GameVendorPlatformFilter::class)
                                          ->withCacheCooldownSeconds(86400)
                                          ->paginate();
        return msgOut($datas);
    }
}
