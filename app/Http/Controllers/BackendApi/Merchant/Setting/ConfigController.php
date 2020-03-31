<?php

namespace App\Http\Controllers\BackendApi\Merchant\Setting;

use App\Http\Requests\Backend\Merchant\Setting\Config\EditRequest;
use App\Http\SingleActions\Backend\Merchant\Setting\Config\EditAction;
use App\Http\SingleActions\Backend\Merchant\Setting\Config\IndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 全域设置
 */
class ConfigController
{

    /**
     * 全域设置-列表
     *
     * @param  IndexAction $action Action.
     * @return JsonResponse
     */
    public function index(IndexAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * 全域设置-编辑
     *
     * @param  EditRequest $request Request.
     * @param  EditAction  $action  Action.
     * @return JsonResponse
     */
    public function edit(EditRequest $request, EditAction $action): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
