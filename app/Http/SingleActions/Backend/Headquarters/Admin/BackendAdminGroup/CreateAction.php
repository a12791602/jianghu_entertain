<?php

namespace App\Http\SingleActions\Backend\Headquarters\Admin\BackendAdminGroup;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\BackendAdminAccessGroup;
use App\Models\DeveloperUsage\Backend\BackendAdminAccessGroupDetail;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class for create action.
 */
class CreateAction extends MainAction
{

    /**
     * @var BackendAdminAccessGroup
     */
    protected $model;

    /**
     * @param Request                 $request                 Request.
     * @param BackendAdminAccessGroup $backendAdminAccessGroup BackendAdminAccessGroup.
     */
    public function __construct(
        Request $request,
        BackendAdminAccessGroup $backendAdminAccessGroup
    ) {
        parent::__construct($request);
        $this->model = $backendAdminAccessGroup;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  array $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        DB::beginTransaction();
        //只提取当前登录管理员也拥有的权限
        $role = Arr::wrap(json_decode($inputDatas['role'], true));
        $role = array_intersect($role, $this->adminAccessGroupDetail);
        //添加AdminGroup数据
        $objAdminGroup = $this->model;
        $objAdminGroup->fill(['group_name' => $inputDatas['group_name']]);
        if (!$objAdminGroup->save()) {
            DB::rollback();
            throw new \Exception('300103');
        }
        //添加AdminGroupDetails数据
        $data = ['group_id' => $objAdminGroup->id];
        foreach ($role as $roleId) {
            $data['menu_id'] = $roleId;
            $groupDetailEloq = new BackendAdminAccessGroupDetail();
            $groupDetailEloq->fill($data);
            if (!$groupDetailEloq->save()) {
                throw new \Exception('300106');
            }
        }
        DB::commit();
        //生成菜单缓存
        $menuEloq = new BackendSystemMenu();
        $menuEloq->createMenuDatas($objAdminGroup->id, $role);
        //返回数据
        $msgData = [
                    'group_name' => $objAdminGroup->group_name,
                    'role'       => $role,
                   ];
        $msgOut  = msgOut($msgData);
        return $msgOut;
    }
}
