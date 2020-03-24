<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\Game;

use Illuminate\Http\JsonResponse;

/**
 * Class EditDoAction
 *
 * @package App\Http\SingleActions\Backend\Headquarters\Game
 */
class EditDoAction extends BaseAction
{

    /**
     * @param  array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $model = $this->model->find($inputDatas['id']);
        if ($model === null) {
            throw new \Exception('300204');
        }
        $inputDatas['last_editor_id'] = $this->user->id;
        $model->fill($inputDatas);
        if (!$model->save()) {
            throw new \Exception('300201');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
