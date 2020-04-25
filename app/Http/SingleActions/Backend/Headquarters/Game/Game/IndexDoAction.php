<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\Game;

use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\Game
 */
class IndexDoAction extends BaseAction
{

    /**
     * @var object $model
     */
    protected $model;
    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $outputDatas = $this->model::with(
            [
             'type:id,name',
             'subType:id,name',
             'vendor:id,name',
             'lastEditor:id,name',
             'author:id,name',
            ],
        )->filter($inputDatas)
        ->paginate();
        return msgOut($outputDatas);
    }
}
