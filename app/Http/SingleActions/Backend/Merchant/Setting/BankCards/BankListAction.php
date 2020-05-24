<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\BankCards;

use App\Http\SingleActions\MainAction;
use App\Models\Finance\SystemPlatformBank;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 银行-列表
 */
class BankListAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemPlatformBank $systemPlatformBank 用户银行卡Model.
     * @param Request            $request            Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemPlatformBank $systemPlatformBank, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemPlatformBank;
    }

    /**
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(): JsonResponse
    {
        $sign     = $this->currentPlatformEloq->sign;
        $bankList = $this->model
        ->where(
            [
             [
              'platform_sign',
              $sign,
             ],
             [
              'status',
              $this->model::STATUS_OPEN,
             ],
            ],
        )->with('bank:id,name')
        ->get(
            [
             'id',
             'bank_id',
            ],
        );

        $results = [];
        foreach ($bankList as $item) {
            $results[] = [
                          'id'   => $item->id,
                          'name' => $item->bank->name ?? null,
                         ];
        }
        return msgOut($results);
    }
}
