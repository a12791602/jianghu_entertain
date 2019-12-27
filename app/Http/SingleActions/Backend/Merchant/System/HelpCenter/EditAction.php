<?php

namespace App\Http\SingleActions\Backend\Merchant\System\HelpCenter;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\System\SystemUsersHelpCenterFilter;
use App\Models\Systems\SystemUsersHelpCenter;
use Illuminate\Http\JsonResponse;

/**
 * 帮助设置-编辑
 */
class EditAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemUsersHelpCenter $systemUsersHelpCenter 洗码Model.
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
        $filterArr  = [
            'dataId' => $inputDatas['id'],
            'sign'   => $contll->currentPlatformEloq->sign,
        ];
        $helpCenter = $this->model
            ->filter($filterArr, SystemUsersHelpCenterFilter::class)
            ->first();
        if (!$helpCenter) {
            throw new \Exception('201301');
        }

        $inputDatas['update_admin_id'] = $contll->currentAdmin->id;
        $helpCenter->fill($inputDatas);
        if (!$helpCenter->save()) {
            throw new \Exception('201302');
        }
        $msgOut = msgOut(true);
        return $msgOut;
    }
}
