<?php

namespace App\Http\SingleActions\Common\Upload;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Services\UploadService;
use Illuminate\Http\JsonResponse;

/**
 * Class UploadAction
 * @package App\Http\SingleActions\Backend\Merchant\Upload
 */
class UploadAction
{
    /**
     * @param BackEndApiMainController $contll     Contll.
     * @param array                    $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $path = $contll->currentPlatformEloq->sign;
        if (isset($inputDatas['basket']) && !empty($inputDatas['basket'])) {
            $path = $contll->currentPlatformEloq->sign . '/' . $inputDatas['basket'];
        }
        $file = (new UploadService())->setSavePath($path)->upload()->getFileInfo();
        if ($file['status']) {
            $result = msgOut(true, $file['file']);
        } else {
            $result = msgOut(false, [], $file['msg']);
        }
        return $result;
    }
}
