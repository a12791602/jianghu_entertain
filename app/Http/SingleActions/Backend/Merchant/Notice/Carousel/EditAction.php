<?php

namespace App\Http\SingleActions\Backend\Merchant\Notice\Carousel;

use App\Models\Systems\StaticResource;
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
        $modelResult                  = $this->model->find($inputDatas['id']);
        if (!$modelResult instanceof $this->model) {
            throw new \Exception('201904');
        }
        if ($modelResult->pic_id !== $inputDatas['pic_id']) {
            StaticResource::resourceClean($modelResult->pic_id);
        }
        $modelResult->fill($inputDatas);
        $result = $modelResult->save();
        if ($result) {
            return msgOut();
        }
        throw new \Exception('201901');
    }
}
