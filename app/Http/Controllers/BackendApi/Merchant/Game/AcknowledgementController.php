<?php

namespace App\Http\Controllers\BackendApi\Merchant\Game;

use App\Http\SingleActions\Backend\Merchant\Acknowledgement\AckInAction;
use App\Http\SingleActions\Backend\Merchant\Acknowledgement\AckOutAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Class AcknowledgementController
 * @package App\Http\Controllers\BackendApi\Merchant\Game
 */
class AcknowledgementController
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
        $headers    = Arr::wrap($request->header());
        return $action->execute($inputDatas, $headers);
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
        $headers    = Arr::wrap($request->header());
        return $action->execute($inputDatas, $headers);
    }
}
