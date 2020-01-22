<?php

namespace App\Http\SingleActions\Backend\Merchant\Email;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Email\SystemEmailFilter;
use App\Models\Email\SystemEmail;
use Illuminate\Http\JsonResponse;

/**
 * Class SendIndexAction
 * @package App\Http\SingleActions\Backend\Merchant\Email
 */
class SendIndexAction extends BaseAction
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
        $pageSize                    = $this->model::getPageSize();
        $inputDatas['platform_sign'] = $contll->currentPlatformEloq->sign;
        $outputDatas                 = $this->model::with('merchant:id,name')
            ->filter($inputDatas, SystemEmailFilter::class)
            ->whereIn(
                'type',
                [
                 SystemEmail::TYPE_MER_TO_HEAD,
                 SystemEmail::TYPE_MER_TO_USER,
                ],
            )->orderByDesc('created_at')->paginate($pageSize);
        $msgOut                      = msgOut($outputDatas);
        return $msgOut;
    }
}
