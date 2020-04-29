<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemSmsConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 短信配置-编辑
 */
class EditAction extends MainAction
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
     * @param array $inputData 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputData): JsonResponse
    {
        $systemSmsConfig = $this->model->find($inputData['id']);
        if (!$systemSmsConfig instanceof $this->model) {
            throw new \Exception('302401');
        }
        if ($systemSmsConfig->sms_remaining < (int) $inputData['sms_num']) {
            throw new \Exception('302402');
        }
        if ((int) $inputData['is_increase'] === SystemSmsConfig::INCREASE) {
             $systemSmsConfig->sms_num       += $inputData['sms_num'];
             $systemSmsConfig->sms_remaining += $inputData['sms_num'];
        } else {
            $systemSmsConfig->sms_remaining -= $inputData['sms_num'];
        }
        $systemSmsConfig->name           = $inputData['name'];
        $systemSmsConfig->last_editor_id = $this->user->id;
        if (!$systemSmsConfig->save()) {
            throw new \Exception('302402');
        }
        $data = ['name' => $systemSmsConfig->name];
        return msgOut($data);
    }
}
