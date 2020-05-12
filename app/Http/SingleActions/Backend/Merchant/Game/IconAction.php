<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use Illuminate\Http\JsonResponse;

/**
 * Class IconAction
 * @package App\Http\SingleActions\Backend\Merchant\GameVendor
 */
class IconAction extends BaseAction
{
    /**
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        try {
            $this->model::where(
                [
                 'id'          => $inputData['id'],
                 'platform_id' => $this->user->platform->id,
                ],
            )->update(['icon_id' => $inputData['icon_id']]);
            return msgOut();
        } catch (\RuntimeException $exception) {
            \Log::error($exception->getMessage());
        }
        throw new \RuntimeException('202700');
    }
}
