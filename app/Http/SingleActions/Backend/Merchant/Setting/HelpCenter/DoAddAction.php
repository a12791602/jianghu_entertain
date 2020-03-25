<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\HelpCenter;

use App\Http\SingleActions\MainAction;
use App\Models\Systems\SystemUsersHelpCenter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 帮助设置-添加
 */
class DoAddAction extends MainAction
{

    /**
     * @var object
     */
    protected $model;

    /**
     * @param SystemUsersHelpCenter $systemUsersHelpCenter 帮助设置Model.
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
        $inputDatas['platform_sign']   = $this->currentPlatformEloq->sign;
        $inputDatas['add_admin_id']    = $this->user->id;
        $inputDatas['update_admin_id'] = $this->user->id;
        $this->model->fill($inputDatas);
        if (!$this->model->save()) {
            throw new \Exception('201300');
        }
        $msgOut = msgOut();
        return $msgOut;
    }
}
