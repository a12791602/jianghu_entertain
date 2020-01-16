<?php

namespace App\Http\SingleActions\Backend\Merchant\System\HelpCenter;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Systems\SystemUsersHelpCenter;
use Illuminate\Http\JsonResponse;

/**
 * 帮助设置-添加
 */
class DoAddAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemUsersHelpCenter $systemUsersHelpCenter 帮助设置Model.
     */
    public function __construct(SystemUsersHelpCenter $systemUsersHelpCenter)
    {
        $this->model = $systemUsersHelpCenter;
    }

    /**
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $inputDatas['platform_sign']   = $contll->currentPlatformEloq->sign;
        $inputDatas['add_admin_id']    = $contll->currentAdmin->id;
        $inputDatas['update_admin_id'] = $contll->currentAdmin->id;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('201300');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
