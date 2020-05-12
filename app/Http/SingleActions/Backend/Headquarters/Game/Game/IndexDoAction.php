<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\Game;

use App\Http\Resources\Backend\Headquarters\Game\Game\IndexResource;
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
     * @param array $inputData InputData.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $outputData = $this->model::with(
            [
             'type:id,name',
             'subType:id,name',
             'vendor',
             'lastEditor:id,name',
             'author:id,name',
             'icon:id,path',
            ],
        )->filter($inputData)
        ->paginate($this->perPage);
        return msgOut(IndexResource::collection($outputData));
    }
}
