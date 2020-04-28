<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemSmsConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 短信配置-删除
 */
class DeleteAction extends MainAction
{

    /**
     * @var SystemSmsConfig
     */
    protected $model;

    /**
     * @param Request         $request         Request.
     * @param SystemSmsConfig $systemSmsConfig 短信配置Model.
     */
    public function __construct(
        Request $request,
        SystemSmsConfig $systemSmsConfig
    ) {
        parent::__construct($request);
        $this->model = $systemSmsConfig;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $systemSmsConfig = $this->model->find($inputDatas['id']);
        if (!$systemSmsConfig instanceof $this->model) {
            throw new \Exception('302401');
        }
        $data = ['name' => $systemSmsConfig->name];
        if (!$systemSmsConfig->delete()) {
            throw new \Exception('302404');
        }
        return msgOut($data);
    }
}
