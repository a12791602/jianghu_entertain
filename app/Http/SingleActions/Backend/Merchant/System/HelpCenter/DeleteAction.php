<?php

namespace App\Http\SingleActions\Backend\Merchant\System\HelpCenter;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\SystemUsersHelpCenterFilter;
use App\Models\Systems\SystemUsersHelpCenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 帮助设置-删除
 */
class DeleteAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemUsersHelpCenter $systemUsersHelpCenter 洗码Model.
     * @param Request               $request               Request.
     * @throws \Exception Exception.
     */
    public function __construct(SystemUsersHelpCenter $systemUsersHelpCenter, Request $request)
    {
        parent::__construct($request);
        $this->model = $systemUsersHelpCenter;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $filterArr       = [
                            'dataId' => $inputDatas['id'],
                            'sign'   => $this->currentPlatformEloq->sign,
                           ];
        $costomerService = $this->model
            ->filter($filterArr, SystemUsersHelpCenterFilter::class)
            ->first();
        if (!$costomerService) {
            throw new \Exception('201301');
        }

        if (!$costomerService->delete()) {
            throw new \Exception('201303');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
