<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Route;

use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use Illuminate\Http\JsonResponse;

/**
 * 路由-编辑
 */
class EditAction
{

    /**
     * @var SystemRoutesBackend
     */
    protected $model;

    /**
     * @param SystemRoutesBackend $systemRoutesBackend Model.
     */
    public function __construct(SystemRoutesBackend $systemRoutesBackend)
    {
        $this->model = $systemRoutesBackend;
    }

    /**
     * @param  array $inputDatas 接收的数据.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $routeEloq = $this->model->find($inputDatas['id']);
        if (!$routeEloq) {
            throw new \Exception('302301');
        }
        $routeEloq->fill($inputDatas);
        if (!$routeEloq->save()) {
            throw new \Exception('302302');
        }
        $msgOut = msgOut(true, ['title' => $routeEloq->title]);
        return $msgOut;
    }
}
