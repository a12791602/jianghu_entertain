<?php

namespace App\Http\SingleActions\Backend\Merchant\System\BankCards;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\System\FrontendUsersBankCardFilter;
use App\Models\Systems\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;

/**
 * 用户银行卡-列表
 */
class IndexAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUsersBankCard $frontendUsersBankCard 用户银行卡Model.
     */
    public function __construct(FrontendUsersBankCard $frontendUsersBankCard)
    {
        $this->model = $frontendUsersBankCard;
    }

    /**
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['sign'] = $contll->currentPlatformEloq->sign;
        $data               = $this->model
            ->filter($inputDatas, FrontendUsersBankCardFilter::class)
            ->get()
            ->toArray();
        $msgOut             = msgOut($data);
        return $msgOut;
    }
}
