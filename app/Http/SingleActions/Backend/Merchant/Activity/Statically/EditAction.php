<?php

namespace App\Http\SingleActions\Backend\Merchant\Activity\Statically;

use Illuminate\Http\JsonResponse;

/**
 * Class EditAction
 * @package App\Http\SingleActions\Backend\Merchant\Notice\Carousel
 */
class EditAction extends BaseAction
{
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $inputDatas['last_editor_id'] = $this->user->id;
        $model                        = $this->model->find($inputDatas['id']);
        $model->fill($inputDatas);
        $result = $model->save();
        if ($result) {
            $msgOut = msgOut();
            return $msgOut;
        }
        throw new \Exception('202001');
    }
}
