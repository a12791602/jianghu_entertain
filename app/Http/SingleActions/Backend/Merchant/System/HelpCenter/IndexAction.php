<?php

namespace App\Http\SingleActions\Backend\Merchant\System\HelpCenter;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\System\SystemUsersHelpCenterFilter;
use App\Models\Systems\SystemUsersHelpCenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 帮助设置-列表
 */
class IndexAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemUsersHelpCenter $systemUsersHelpCenter 帮助中心Model.
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
        $inputDatas['sign'] = $this->currentPlatformEloq->sign;
        $data               = $this->model
            ->filter($inputDatas, SystemUsersHelpCenterFilter::class)
            ->with(['author:id,name', 'newer:id,name'])
            ->get(
                [
                 'id',
                 'title',
                 'pic',
                 'type',
                 'status',
                 'created_at',
                 'updated_at',
                 'add_admin_id',
                 'update_admin_id',
                ],
            );
        $msgOut             = msgOut($data);
        return $msgOut;
    }
}
