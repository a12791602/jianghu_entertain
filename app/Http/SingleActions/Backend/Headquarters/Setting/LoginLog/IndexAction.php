<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\LoginLog;

use App\ModelFilters\System\BackendLoginLogFilter;
use App\Models\Systems\BackendLoginLog;
use Illuminate\Http\JsonResponse;

/**
 * 管理员登录日志
 */
class IndexAction
{

    /**
     * Comment
     * @var BackendLoginLog
     */
    protected $model;

    /**
     * @param BackendLoginLog $backendLoginLog 管理员登陆日志.
     */
    public function __construct(BackendLoginLog $backendLoginLog)
    {
        $this->model = $backendLoginLog;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $data = $this->model
            ->filter($inputDatas, BackendLoginLogFilter::class)
            ->paginate($this->model::getPageSize());
            
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
