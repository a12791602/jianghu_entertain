<?php

namespace App\Http\SingleActions\Backend\Merchant\Acknowledgement;

use App\Http\SingleActions\MainAction;
use App\JHHYLibs\GameCommons;
use App\Models\Game\GameVendor;

/**
 * Class AckInAction
 * @package App\Http\SingleActions\Backend\Merchant\Acknowledgement
 */
class AckInAction extends MainAction
{

    /**
     * @param array $inputDatas 参数.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response return.
     * @throws \Exception|\RuntimeException Exception.
     */
    public function execute(array $inputDatas = [])
    {
        $curentVendorObj = GameVendor::where('sign', 'VR')->first();
        if ($curentVendorObj === null) {
            throw new \RuntimeException('203200');
        }
        $gameInstance = GameCommons::gameInit($curentVendorObj);
        $gameInstance->downScore($inputDatas);
        return $gameInstance->msgOut();
    }
}
