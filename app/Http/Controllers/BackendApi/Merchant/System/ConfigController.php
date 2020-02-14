<?php

namespace App\Http\Controllers\BackendApi\Merchant\System;

use App\Http\Requests\Backend\Merchant\System\Config\EditRequest;
use App\Http\SingleActions\Backend\Merchant\System\Config\EditAction;
use Illuminate\Http\JsonResponse;

/**
 * 全域设置
 */
class ConfigController
{

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
        $msgOut     = $action->execute($inputDatas);
        return $msgOut;
    }
}
