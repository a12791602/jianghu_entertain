<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Route;

use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use Illuminate\Http\JsonResponse;

/**
 * 路由-删除
 */
class DeleteAction
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
        $title = $routeEloq->title;
        if (!$routeEloq->delete()) {
            throw new \Exception('302303');
        }
        $msgOut = msgOut(true, ['title' => $title]);
        return $msgOut;
    }
}
