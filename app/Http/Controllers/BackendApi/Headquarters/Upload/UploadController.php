<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Upload;

use App\Http\Requests\Backend\Headquarters\Upload\UploadImageRequest;
use App\Http\SingleActions\Backend\Headquarters\Upload\UploadImageAction;
use Illuminate\Http\JsonResponse;

/**
 * Class UploadController
 * @package App\Http\Controllers\Headquarters\Upload
 */
class UploadController
{

    /**
     * Public image upload.
     * @param UploadImageAction  $action  UploadImageAction.
     * @param UploadImageRequest $request UploadImageRequest.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function uploadImage(
        UploadImageAction $action,
        UploadImageRequest $request
    ): JsonResponse {
        $result = $action->execute($request);
        return $result;
    }
}
