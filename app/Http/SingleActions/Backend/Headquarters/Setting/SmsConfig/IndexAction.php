<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\SmsConfig;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemSmsConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 短信配置-列表
 */
class IndexAction extends MainAction
{

    /**
     * Comment
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
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $data = $this->model
            ->filter($inputDatas)
            ->select(
                [
                 'id',
                 'name',
                 'sign',
                 'merchant_code',
                 'merchant_secret',
                 'public_key',
                 'authorization_code',
                 'sms_num',
                 'url',
                 'status',
                 'last_editor_id',
                 'updated_at',
                 'created_at',
                ],
            )->with('admin:id,name')
            ->paginate();
        return msgOut($data);
    }
}
