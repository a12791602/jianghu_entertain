<?php

namespace App\Http\Controllers\BackendApi\Merchant\Game;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\SingleActions\Backend\Merchant\Acknowledgement\AckInAction;
use App\Http\SingleActions\Backend\Merchant\Acknowledgement\AckOutAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AcknowledgementController
 * @package App\Http\Controllers\BackendApi\Merchant\Game
 */
class AcknowledgementController extends BackEndApiMainController
{
    /**
     * @param Request     $request Request.
     * @param AckInAction $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function ackIn(
        Request $request,
        AckInAction $action
    ): JsonResponse {
        $inputDatas = $request->all();
        $headers    = $request->header();
        $result     = $action->execute($inputDatas, $headers);
        return $result;
    }

    /**
     * @param Request      $request Request.
     * @param AckOutAction $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function ackOut(
        Request $request,
        AckOutAction $action
    ): JsonResponse {
        $inputDatas = $request->all();
        $headers    = $request->header();
        $result     = $action->execute($inputDatas, $headers);
        return $result;
    }
}
