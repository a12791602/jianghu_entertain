<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Admin\BackendAdminAccessGroup;
use App\Models\DeveloperUsage\Backend\BackendAdminAccessGroupDetail;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class for create action.
 */
class CreateAction
{

    /**
     * @var BackendAdminAccessGroup
     */
    protected $model;

    /**
     * @param BackendAdminAccessGroup $backendAdminAccessGroup BackendAdminAccessGroup.
     */
    public function __construct(BackendAdminAccessGroup $backendAdminAccessGroup)
    {
        $this->model = $backendAdminAccessGroup;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 传递的参数.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        DB::beginTransaction();
        try {
            //只提取当前登录管理员也拥有的权限
            $role = Arr::wrap(json_decode($inputDatas['role'], true));
            $role = array_intersect($role, $contll->adminAccessGroupDetail);

            //添加AdminGroup数据
            $objAdminGroup = $this->model;
            $objAdminGroup->fill(['group_name' => $inputDatas['group_name']]);
            $objAdminGroup->save();

            //添加AdminGroupDetails数据
            $data = ['group_id' => $objAdminGroup->id];
            foreach ($role as $roleId) {
                $data['menu_id'] = $roleId;
                $groupDetailEloq = new BackendAdminAccessGroupDetail();
                $groupDetailEloq->fill($data);
                $groupDetailEloq->save();
            }

            $menuEloq = new BackendSystemMenu();
            $menuEloq->createMenuDatas($objAdminGroup->id, $role);

            DB::commit();
            $msgData = [
                'group_name' => $objAdminGroup->group_name,
                'role'     => $role,
            ];
            $msgOut  = msgOut(true, $msgData);
        } catch (\Throwable $e) {
            DB::rollback();
            $msgOut = msgOut(false, [], $e->getCode(), $e->getMessage());
        }
        return $msgOut;
    }
}
