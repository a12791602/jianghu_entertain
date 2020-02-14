<?php

namespace App\Http\SingleActions\Backend\Merchant\System\Config;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemConfiguration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
        $param        = $inputDatas['param'][0] ?? [];
        $platformSign = $this->currentPlatformEloq->sign;
        DB::beginTransaction();
        foreach ($param as $sign => $item) {
            $configEloq = $this->model->where(
                [
                 'platform_sign' => $platformSign,
                 'sign'          => $sign,
                ],
            )->first();
            if (!$configEloq) {
                DB::rollback();
                throw new \Exception('202500');
            }
            $editData = Arr::only($item, ['value', 'status']);
            $configEloq->fill($editData);
            if (!$configEloq->save()) {
                DB::rollback();
                throw new \Exception('202501');
            }
        }
        DB::commit();
        $msgOut = msgOut();
        return $msgOut;
    }
}
