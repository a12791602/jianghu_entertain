<?php

namespace App\Http\Controllers\CommonApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\Upload\UploadRequest;
use App\Http\SingleActions\Common\Upload\UploadAction;
use Illuminate\Http\JsonResponse;

/**
 * Class UploadController
 * @package App\Http\Controllers\CommonApi
 */
class UploadController extends Controller
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
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
