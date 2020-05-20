<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\System;

use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\System
 */
class EditAction extends BaseAction
{
    /**
     * ***
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['last_editor_id'] = $this->user->id;
        $inputDatas['device']         = $this->model->getDevice($inputDatas);
        $modelResult                  = $this->model->find($inputDatas['id']);
        if (!$modelResult instanceof $this->model) {
            throw new \Exception('201704');
        }
        $modelResult->cleanResource($inputDatas);
        $modelResult->fill($inputDatas);
        $result = $modelResult->save();
        if ($result) {
            return msgOut();
        }
        throw new \Exception('201701');
    }
}
