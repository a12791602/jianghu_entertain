<?php

namespace App\Http\Controllers\BackendApi\Merchant\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\GameAcknowledgement\AckInRequest;
use App\Http\Requests\Backend\Merchant\GameAcknowledgement\AckOutRequest;
use App\Http\SingleActions\Backend\Merchant\Acknowledgement\AckInAction;
use App\Http\SingleActions\Backend\Merchant\Acknowledgement\AckOutAction;

/**
 * Class AcknowledgementController
 * @package App\Http\Controllers\BackendApi\Merchant\Game
 */
class GameAcknowledgementController extends Controller
{
    /**
     * @param AckInAction  $action  Action.
     * @param AckInRequest $request Request.
     * @return void
     * @throws \Exception Exception.
     */
    public function ackIn(
        AckInAction $action,
        AckInRequest $request
    ): void {
        logAllRequestInfos('ack-center', 'AckIn');
        $inputDatas = $request->validated();
        $action->execute($inputDatas);
    }

    /**
     * @param AckOutAction  $action  Action.
     * @param AckOutRequest $request Request.
     * @return void
     * @throws \Exception Exception.
     */
    public function ackOut(
        AckOutAction $action,
        AckOutRequest $request
    ): void {
        logAllRequestInfos('ack-center', 'AckOut');
        $inputDatas = $request->validated();
        $action->execute($inputDatas);
    }
}
