<?php

namespace App\Http\SingleActions\Backend\Merchant\Game;

use App\Models\Systems\StaticResource;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class IconDownloadAction
 * @package App\Http\SingleActions\Backend\Merchant\GameVendor
 */
class IconDownloadAction
{
    /**
     * @param array $inputData InputData.
     * @return BinaryFileResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputData): BinaryFileResponse
    {
        $resource = StaticResource::find($inputData['icon_id']);
        if (!$resource instanceof StaticResource) {
            throw new \RuntimeException();
        }
        return response()->download(storage_path('statics/' . $resource->path));
    }
}
