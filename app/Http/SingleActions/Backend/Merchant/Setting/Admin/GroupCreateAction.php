<?php

namespace App\Http\SingleActions\Backend\Merchant\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\ModelFilters\Admin\MerchantAdminAccessGroupFilter;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminAccessGroupsHasBackendSystemMenu;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class for group create action.
 */
class GroupCreateAction extends MainAction
{

    /**
     * @var MerchantAdminAccessGroup
     */
    protected $model;

    /**
     * @param MerchantAdminAccessGroup $merchantAdminAccessGroup MerchantAdminAccessGroup.
     * @param Request                  $request                  Request.
     * @throws \Exception Exception.
     */
    public function __construct(
        MerchantAdminAccessGroup $merchantAdminAccessGroup,
        Request $request
    ) {
        parent::__construct($request);
        $this->model = $merchantAdminAccessGroup;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $platformSign = $this->currentPlatformEloq->sign;

        $filterArr    = [
                         'platform'  => $platformSign,
                         'groupName' => $inputDatas['group_name'],
                        ];
        $nameIsExists = $this->model::filter($filterArr, MerchantAdminAccessGroupFilter::class)->exists();
        if ($nameIsExists === true) {
            throw new Exception('300102');
        }

        DB::beginTransaction();
        //添加AdminGroup数据
        $groupData  = [
                       'group_name'    => $inputDatas['group_name'],
                       'platform_sign' => $platformSign,
                      ];
        $adminGroup = $this->model;
        $adminGroup->fill($groupData);
        if (!$adminGroup->save()) {
            DB::rollback();
            throw new Exception('200900');
        }

        //只提取当前登录管理员也拥有的权限,添加AdminGroupDetails权限数据
        $role = array_intersect($inputDatas['role'], $this->adminAccessGroupDetail);
        $data = ['group_id' => $adminGroup->id];
        foreach ($role as $roleId) {
            $data['menu_id'] = $roleId;
            $groupDetailEloq = new MerchantAdminAccessGroupsHasBackendSystemMenu();
            $groupDetailEloq->fill($data);
            if (!$groupDetailEloq->save()) {
                DB::rollback();
                throw new Exception('200901');
            }
        }
        DB::commit();
        $msgOut = msgOut();
        return $msgOut;
    }
}
