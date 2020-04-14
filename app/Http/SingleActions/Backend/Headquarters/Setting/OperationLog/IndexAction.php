<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\OperationLog;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\SystemLogsBackendFilter;
use App\Models\Systems\SystemLogsBackend;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 操作日志-列表
 */
class IndexAction extends MainAction
{

    /**
     * Comment
     * @var SystemLogsBackend
     */
    protected $model;

    /**
     * @param Request           $request           Request.
     * @param SystemLogsBackend $systemLogsBackend 后台操作日志.
     */
    public function __construct(
        Request $request,
        SystemLogsBackend $systemLogsBackend
    ) {
        parent::__construct($request);
        $this->model = $systemLogsBackend;
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
        $result = $this->model
            ->filter($inputDatas, SystemLogsBackendFilter::class)
            ->select(
                [
                 'origin',
                 'ip',
                 'user_agent',
                 'inputs',
                 'route_id',
                 'admin_name',
                 'created_at',
                ],
            )
            ->with('route:id,title')
            ->paginate()
            ->toArray();

        $data = [];
        foreach ($result['data'] as $time) {
            $data[] = [
                       'title'      => $time['route']['title'] ?? '',
                       'admin_name' => $time['admin_name'],
                       'created_at' => $time['created_at'],
                       'origin'     => $time['origin'],
                       'ip'         => $time['ip'],
                       'user_agent' => $time['user_agent'],
                      ];
        }

        $result['data'] = $data;
        return msgOut($result);
    }
}
