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

        $inputDatas['maintain_start'] = $inputDatas['maintain_start'] ?? null;
        $inputDatas['maintain_end']   = $inputDatas['maintain_end'] ?? null;

        $systemPlatform->fill($inputDatas);
        if (!$systemPlatform->save()) {
            throw new \Exception('302006');
        }

        $msgOut = msgOut(true);
        return $msgOut;
    }
}
