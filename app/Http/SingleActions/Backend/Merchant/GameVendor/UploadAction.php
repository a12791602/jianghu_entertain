<?php

namespace App\Http\SingleActions\Backend\Merchant\GameVendor;

use Illuminate\Http\JsonResponse;

/**
 * Class UploadAction
 * @package App\Http\SingleActions\Backend\Merchant\GameVendor
 */
class UploadAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $result = $this->model::where(
            [
             'id'          => $inputDatas['id'],
             'platform_id' => $this->user->platform->id,
            ],
        )->update(['icon' => $inputDatas['icon']]);
        if ($result) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('202700');
    }
}
