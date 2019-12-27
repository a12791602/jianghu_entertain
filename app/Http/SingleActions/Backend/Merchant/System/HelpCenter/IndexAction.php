<?php

namespace App\Http\SingleActions\Backend\Merchant\System\HelpCenter;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\System\SystemUsersHelpCenterFilter;
use App\Models\Systems\SystemUsersHelpCenter;
use Illuminate\Http\JsonResponse;

/**
 * 帮助设置-列表
 */
class IndexAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemUsersHelpCenter $systemUsersHelpCenter 帮助中心Model.
     */
    public function __construct(SystemUsersHelpCenter $systemUsersHelpCenter)
    {
        $this->model = $systemUsersHelpCenter;
    }

    /**
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 接收的参数.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['sign'] = $contll->currentPlatformEloq->sign;
        $data               = $this->model
            ->filter($inputDatas, SystemUsersHelpCenterFilter::class)
            ->get()
            ->toArray();
        $msgOut             = msgOut(true, $data);
        return $msgOut;
    }
}
