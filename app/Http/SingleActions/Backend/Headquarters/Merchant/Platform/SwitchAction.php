<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemPlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for system platform switch action.
 */
class SwitchAction extends MainAction
{

    /**
     * 代理商平台model.
     *
     * @var SystemPlatform
     */
    protected $model;

    /**
     * @param Request        $request        Request.
     * @param SystemPlatform $systemPlatform 代理商平台.
     */
    public function __construct(
        Request $request,
        SystemPlatform $systemPlatform
    ) {
        parent::__construct($request);
        $this->model = $systemPlatform;
    }

    /**
     * @param  array $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $platformEloq = $this->model::find($inputDatas['id']);
        if (!$platformEloq instanceof $this->model) {
            throw new \Exception('300706');
        }
        $platformEloq->status = $inputDatas['status'];
        if (!$platformEloq->save()) {
            throw new \Exception('300707');
        }
        return msgOut();
    }
}
