<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\Config;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemConfiguration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 全域设置-编辑
 */
class EditAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemConfiguration $systemConfiguration 洗码Model.
     * @param Request             $request             Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemConfiguration $systemConfiguration, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemConfiguration;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $platformSign = $this->currentPlatformEloq->sign;
        $configEloq   = $this->model->where(
            [
             'platform_sign' => $platformSign,
             'sign'          => $inputDatas['sign'],
            ],
        )->first();
        if (!$configEloq) {
            DB::rollback();
            throw new \Exception('202500');
        }
        $editData = [$inputDatas['key'] => $inputDatas['value']];
        $configEloq->fill($editData);
        if (!$configEloq->save()) {
            throw new \Exception('202501');
        }
        return msgOut(['key' => $inputDatas['key'], 'value' => $inputDatas['value']]);
    }
}
