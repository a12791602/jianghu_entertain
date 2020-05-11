<?php

namespace App\Http\SingleActions\Backend\Headquarters\Upload;

use App\Http\Requests\Backend\Headquarters\Upload\UploadImageRequest;
use App\Models\Systems\StaticResource;
use App\Services\UploadService;
use Illuminate\Http\JsonResponse;

/**
 * Class UploadAction
 * @package App\Http\SingleActions\Backend\Headquarters\Upload
 */
class UploadImageAction
{
    /**
     * Public image upload.
     * @param UploadImageRequest $request UploadImageRequest.
     * @return JsonResponse
     * @throws \RuntimeException RuntimeException.
     */
    public function execute(UploadImageRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $path      = $validated['path'];
        $file      = (new UploadService())->setSavePath($path)->upload()->getFileInfo();
        if (!$file['status']) {
            throw new \RuntimeException('201100');
        }
        $resource           = ['path' => $file['file']['path']];
        $model_item         = StaticResource::create($resource);
        $file['file']['id'] = $model_item->id;
        return msgOut($file['file']);
    }
}
