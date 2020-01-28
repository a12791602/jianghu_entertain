<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Dynamic;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Platform\SystemDynActivityPlatformFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Activity\Dyn
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
        $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
        $data                        = $this->model::with('lastEditor:id,name', 'activity:id,sign,name')
            ->filter($inputDatas, SystemDynActivityPlatformFilter::class)
            ->withCacheCooldownSeconds(86400)->get();
        $msgOut                      = msgOut($data);
        return $msgOut;
    }
}
