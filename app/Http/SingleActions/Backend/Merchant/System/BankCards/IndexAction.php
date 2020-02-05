<?php

namespace App\Http\SingleActions\Backend\Merchant\System\BankCards;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\FrontendUsersBankCardFilter;
use App\Models\Systems\FrontendUsersBankCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 用户银行卡-列表
 */
class IndexAction extends MainAction
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
        $inputDatas['sign'] = $this->currentPlatformEloq->sign;
        $data               = $this->model
            ->filter($inputDatas, FrontendUsersBankCardFilter::class)
            ->get()
            ->toArray();
        $msgOut             = msgOut($data);
        return $msgOut;
    }
}
