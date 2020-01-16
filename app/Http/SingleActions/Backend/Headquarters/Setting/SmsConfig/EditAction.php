<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Systems\SystemSmsConfig;
use Illuminate\Http\JsonResponse;

/**
 * 短信配置-编辑
 */
class EditAction
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
        $systemSmsConfig = $this->model->find($inputDatas['id']);
        if (!$systemSmsConfig) {
            throw new \Exception('302401');
        }
        
        $inputDatas['last_editor_id'] = $contll->currentAdmin->id;
        $systemSmsConfig->fill($inputDatas);
        if (!$systemSmsConfig->save()) {
            throw new \Exception('302402');
        }

        $data   = ['name' => $systemSmsConfig->name];
        $msgOut = msgOut(true, $data);
        return $msgOut;
    }
}
