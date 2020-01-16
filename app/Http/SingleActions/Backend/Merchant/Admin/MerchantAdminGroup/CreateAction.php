<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminGroup;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\ModelFilters\Admin\MerchantAdminAccessGroupFilter;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminAccessGroupsHasBackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class for create action.
 */
class CreateAction
{

    /**
     * @var MerchantAdminAccessGroup
     */
    protected $model;

    /**
     * @param MerchantAdminAccessGroup $merchantAdminAccessGroup MerchantAdminAccessGroup.
     */
    public function __construct(MerchantAdminAccessGroup $merchantAdminAccessGroup)
    {
        $this->model = $merchantAdminAccessGroup;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $platformSign = $contll->currentPlatformEloq->sign;

        $filterArr    = [
                         'platform'  => $platformSign,
                         'groupName' => $inputDatas['group_name'],
                        ];
        $nameIsExists = $this->model::filter($filterArr, MerchantAdminAccessGroupFilter::class)->exists();
        if ($nameIsExists === true) {
            throw new \Exception('300102');
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
            throw new \Exception('200900');
        }

        //只提取当前登录管理员也拥有的权限,添加AdminGroupDetails权限数据
        $role = Arr::wrap(json_decode($inputDatas['role'], true));
        $role = array_intersect($role, $contll->adminAccessGroupDetail);
        $data = ['group_id' => $adminGroup->id];
        foreach ($role as $roleId) {
            $data['menu_id'] = $roleId;
            $groupDetailEloq = new MerchantAdminAccessGroupsHasBackendSystemMenu();
            $groupDetailEloq->fill($data);
            if (!$groupDetailEloq->save()) {
                DB::rollback();
                throw new \Exception('200901');
            }
        }
        DB::commit();
        $msgOut = msgOut();
        return $msgOut;
    }
}
