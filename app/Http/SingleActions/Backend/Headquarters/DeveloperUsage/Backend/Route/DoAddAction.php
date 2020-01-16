<?php

namespace App\Http\SingleActions\Backend\Headquarters\DeveloperUsage\Backend\Route;

use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use Illuminate\Http\JsonResponse;

/**
 * 路由-添加
 */
class DoAddAction
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
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('302300');
        }
        $msgOut = msgOut(['title' => $this->model->title]);
        return $msgOut;
    }
}
