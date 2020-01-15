<?php

namespace App\Http\SingleActions\Backend\Merchant\System\BankCards;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\System\FrontendUsersBankCardFilter;
use App\Models\Systems\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;

/**
 * 银行卡反查-删除
 */
class DeleteAction
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
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $filterArr = [
                      'dataId' => $inputDatas['id'],
                      'sign'   => $contll->currentPlatformEloq->sign,
                     ];
        $bankCards = $this->model
            ->filter($filterArr, FrontendUsersBankCardFilter::class)
            ->first();
        if (!$bankCards) {
            throw new \Exception('201500');
        }

        if (!$bankCards->delete()) {
            throw new \Exception('201501');
        }
        $msgOut = msgOut(true);
        return $msgOut;
    }
}
