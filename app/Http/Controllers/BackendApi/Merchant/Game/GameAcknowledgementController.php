<?php

namespace App\Http\Controllers\BackendApi\Merchant\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\Game\AckInRequest;
use App\Http\SingleActions\Backend\Merchant\Acknowledgement\AckInAction;
use App\Http\SingleActions\Backend\Merchant\Acknowledgement\AckOutAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AcknowledgementController
 * @package App\Http\Controllers\BackendApi\Merchant\Game
 */
class GameAcknowledgementController extends Controller
{
    /**
     * @param AckInRequest $request Request.
     * @param AckInAction  $action  Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function ackIn(
        AckInRequest $request,
        AckInAction $action
    ): JsonResponse {
        logAllRequestInfos('ack-center', 'AckIn');
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
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
        logAllRequestInfos('ack-center', 'AckOut');
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
