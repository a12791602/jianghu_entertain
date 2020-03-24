<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Admin\BackendAdminAccessGroupFilter;
use App\Models\Admin\BackendAdminAccessGroup;
use App\Models\Admin\BackendAdminUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * 修改管理员所属组
 */
class UpdateAdminGroupAction extends MainAction
{

    /**
     * @var object $model
     */
    protected $model;

    /**
     * @param Request          $request          Request.
     * @param BackendAdminUser $backendAdminUser BackendAdminUser.
     */
    public function __construct(
        Request $request,
        BackendAdminUser $backendAdminUser
    ) {
        parent::__construct($request);
        $this->model = $backendAdminUser;
    }

    /**
     * 修改管理员的归属组
     * @param array $inputDatas 接收的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        //验证管理员
        $adminEloq = $this->model::find($inputDatas['id']);
        if ($adminEloq === null) {
            throw new \Exception('301100');
        }
        //验证管理组
        $filterArr     = [
                          'id'        => $inputDatas['group_id'],
                          'groupName' => $inputDatas['group_name'],
                         ];
        $groupIsExists = BackendAdminAccessGroup::filter($filterArr, BackendAdminAccessGroupFilter::class)->exists();
        if ($groupIsExists === false) {
            throw new \Exception('301101');
        }
        //修改管理员所属组
        $adminEloq->group_id = $inputDatas['group_id'];
        $adminEloq->save();
        //返回信息
        $data   = [
                   'admin_name' => $adminEloq->name,
                   'group_name' => $inputDatas['group_name'],
                  ];
        $msgOut = msgOut($data);
        return $msgOut;
    }
}
