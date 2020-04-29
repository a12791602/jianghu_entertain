<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemSmsConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 短信配置-添加
 */
class DoAddAction extends MainAction
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
        $inputDatas['author_id']      = $this->user->id;
        $inputDatas['last_editor_id'] = $this->user->id;
        $this->model->fill($inputDatas);
        $this->model->sms_remaining = $inputDatas['sms_num'];
        if (!$this->model->save()) {
            throw new \Exception('302400');
        }

        $data = ['name' => $this->model->name];
        return msgOut($data);
    }
}
