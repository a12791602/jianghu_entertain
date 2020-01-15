<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Models\Systems\SystemPlatform;
use Illuminate\Http\JsonResponse;

/**
 * Class for maintain action.
 */
class MaintainAction
{

    /**
     * Comment
     *
     * @var SystemPlatform
     */
    protected $model;

    /**
     * @param SystemPlatform $systemPlatform 代理商平台.
     */
    public function __construct(SystemPlatform $systemPlatform)
    {
        $this->model = $systemPlatform;
    }

    /**
     * @param  array $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $systemPlatform = $this->model->find($inputDatas['id']);
        if (!$systemPlatform) {
            throw new \Exception('302003');
        }
        if (isset($inputDatas['start_time']) && isset($inputDatas['end_time'])) {
            $maintainTime                  = [
                                              $inputDatas['start_time'],
                                              $inputDatas['end_time'],
                                             ];
            $systemPlatform->maintain_time = json_encode($maintainTime);
        } else {
            $systemPlatform->maintain_time = null;
        }
        if (!$systemPlatform->save()) {
            throw new \Exception('302006');
        }
        $msgOut = msgOut(true);
        return $msgOut;
    }
}
