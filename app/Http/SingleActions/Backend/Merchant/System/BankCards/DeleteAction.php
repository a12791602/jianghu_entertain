<?php

namespace App\Http\SingleActions\Backend\Merchant\System\BankCards;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\User\FrontendUsersBankCardFilter;
use App\Models\User\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 银行卡反查-删除
 */
class DeleteAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param FrontendUsersBankCard $frontendUsersBankCard 用户银行卡Model.
     * @param Request               $request               Request.
     * @throws \Exception Exception.
     */
    public function __construct(FrontendUsersBankCard $frontendUsersBankCard, Request $request)
    {
        parent::__construct($request);
        $this->model = $frontendUsersBankCard;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $filterArr = [
                      'dataId' => $inputDatas['id'],
                      'sign'   => $this->currentPlatformEloq->sign,
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
        $msgOut = msgOut();
        return $msgOut;
    }
}
