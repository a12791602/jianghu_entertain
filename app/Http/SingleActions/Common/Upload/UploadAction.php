<?php

namespace App\Http\SingleActions\Common\Upload;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\StaticResource;
use App\Services\UploadService;
use Illuminate\Http\JsonResponse;

/**
 * Class UploadAction
 * @package App\Http\SingleActions\Backend\Merchant\Upload
 */
class UploadAction extends MainAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $path = $this->currentPlatformEloq->sign;
        if (isset($inputDatas['basket']) && !empty($inputDatas['basket'])) {
            $path = $this->currentPlatformEloq->sign . '/' . $inputDatas['basket'];
        }
        $file = (new UploadService())->setSavePath($path)->upload()->getFileInfo();
        if (!$file['status']) {
            throw new \Exception('201100');
        }
        $resource           = ['path' => $file['file']['path']];
        $model_item         = StaticResource::create($resource);
        $file['file']['id'] = $model_item->id;
        return msgOut($file['file']);
    }
}
