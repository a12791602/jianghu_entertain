<?php

namespace App\Http\SingleActions\Backend\Merchant\Admin\MerchantAdminGroup;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminAccessGroupsHasBackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class for edit action.
 */
class EditAction
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
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $adminGroupELoq = $this->model::find($inputDatas['id']);
        if ($adminGroupELoq === null) {
            throw new \Exception('200902');
        }
        if ($adminGroupELoq->is_super === 1) {
            throw new \Exception('200905');
        }

        DB::beginTransaction();
        $adminGroupELoq->group_name = $inputDatas['group_name'];
        if (!$adminGroupELoq->save()) {
            throw new \Exception('200904');
        }

        MerchantAdminAccessGroupsHasBackendSystemMenu::where('group_id', $inputDatas['id'])->delete();

        //只提取当前登录管理员也拥有的权限
        $role = Arr::wrap(json_decode($inputDatas['role'], true));
        $role = array_intersect($contll->adminAccessGroupDetail, $role);

        //添加AdminGroupDetails数据
        $data = ['group_id' => $inputDatas['id']];
        foreach ($role as $roleId) {
            $data['menu_id'] = $roleId;
            $groupDetailEloq = new MerchantAdminAccessGroupsHasBackendSystemMenu();
            $groupDetailEloq->fill($data);
            if (!$groupDetailEloq->save()) {
                throw new \Exception('200906');
            }
        }

        DB::commit();
        $msgOut = msgOut(true, $adminGroupELoq->toArray());
        return $msgOut;
    }
}
