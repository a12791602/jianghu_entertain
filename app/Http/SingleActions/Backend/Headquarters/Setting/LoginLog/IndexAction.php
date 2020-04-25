<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\LoginLog;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\BackendLoginLogFilter;
use App\Models\Systems\BackendLoginLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 管理员登录日志
 */
class IndexAction extends MainAction
{

    /**
     * Comment
     * @var BackendLoginLog
     */
    protected $model;

    /**
     * @param Request         $request         Request.
     * @param BackendLoginLog $backendLoginLog 管理员登陆日志.
     */
    public function __construct(
        Request $request,
        BackendLoginLog $backendLoginLog
    ) {
        parent::__construct($request);
        $this->model = $backendLoginLog;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $data = $this->model
            ->filter($inputDatas, BackendLoginLogFilter::class)
            ->select(
                [
                 'email',
                 'ip',
                 'created_at',
                ],
            )->paginate();
        return msgOut($data);
    }
}
