<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Login;

use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Login
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
        $model                        = $this->model->find($inputDatas['id']);
        if (!$model instanceof $this->model) {
            throw new \Exception('201804');
        }
        $model->fill($inputDatas);
        $result = $model->save();
        if ($result) {
            return msgOut();
        }
        throw new \Exception('201801');
    }
}
