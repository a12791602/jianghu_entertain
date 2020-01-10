<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig;

use App\Models\Systems\SystemSmsConfig;
use Illuminate\Http\JsonResponse;

/**
 * 短信配置-禁用启用
 */
class StatusAction
{

    /**
     * @var SystemSmsConfig
     */
    protected $model;

    /**
     * @param SystemSmsConfig $systemSmsConfig 短信配置Model.
     */
    public function __construct(SystemSmsConfig $systemSmsConfig)
    {
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
        if (!$systemSmsConfig) {
            throw new \Exception('302401');
        }
        $systemSmsConfig->status = $inputDatas['status'];
        if (!$systemSmsConfig->save()) {
            throw new \Exception('302403');
        }

        $data   = ['name' => $systemSmsConfig->name];
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
