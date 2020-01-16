<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Systems\SystemSmsConfig;
use Illuminate\Http\JsonResponse;

/**
 * 短信配置-添加
 */
class DoAddAction
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
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['author_id']      = $contll->currentAdmin->id;
        $inputDatas['last_editor_id'] = $contll->currentAdmin->id;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('302400');
        }

        $data   = ['name' => $this->model->name];
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
