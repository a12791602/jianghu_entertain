<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\HelpCenter;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\SystemUsersHelpCenterFilter;
use App\Models\Systems\SystemUsersHelpCenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 帮助设置-编辑
 */
class EditAction extends MainAction
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
        $filterArr  = [
                       'dataId' => $inputDatas['id'],
                       'sign'   => $this->currentPlatformEloq->sign,
                      ];
        $helpCenter = $this->model
            ->filter($filterArr, SystemUsersHelpCenterFilter::class)
            ->first();
        if (!$helpCenter) {
            throw new \Exception('201301');
        }

        $inputDatas['update_admin_id'] = $this->user->id;
        $helpCenter->fill($inputDatas);
        if (!$helpCenter->save()) {
            throw new \Exception('201302');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
