<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemPlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class for maintain action.
 */
class MaintainAction extends MainAction
{

    /**
     * Comment
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

        $msgOut = msgOut();
        return $msgOut;
    }
}
