<?php

namespace App\Http\Controllers\CommonApi;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Http\Requests\Common\Upload\UploadRequest;
use App\Http\SingleActions\Common\Upload\UploadAction;
use Illuminate\Http\JsonResponse;

/**
 * Class UploadController
 * @package App\Http\Controllers\CommonApi
 */
class UploadController extends BackEndApiMainController
{
    /**
     * 上传
     * @param UploadAction  $action  Action.
     * @param UploadRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function upload(UploadAction $action, UploadRequest $request): JsonResponse
    {
        $inputDatas  = $request->validated();
        $outputDatas = $action->execute($this, $inputDatas);
        return $outputDatas;
    }
}
