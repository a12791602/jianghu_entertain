<?php

namespace App\Http\SingleActions\Backend\Headquarters\Setting\Admin;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\BackendAdminAccessGroup;
use App\Models\DeveloperUsage\Backend\BackendAdminAccessGroupDetail;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *  Class for group edit action.
 */
class GroupEditAction extends MainAction
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
     * @param  array $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $id = $inputDatas['id'];
        if ((int) $id === 1) {
            throw new \Exception('300101');
        }
        $datas = $this->model->find($id);
        if (!$datas instanceof $this->model) {
            throw new \Exception('300100');
        }
        DB::beginTransaction();
        try {
            $datas->group_name = $inputDatas['group_name'];
            $datas->save();
            //只提取当前登录管理员也拥有的权限
            BackendAdminAccessGroupDetail::where('group_id', $id)->delete();
            $role = array_intersect($this->adminAccessGroupDetail, $inputDatas['role']);
            //添加AdminGroupDetails数据
            $data = ['group_id' => $id];
            foreach ($role as $roleId) {
                $data['menu_id'] = $roleId;
                $groupDetailEloq = new BackendAdminAccessGroupDetail();
                $groupDetailEloq->fill($data);
                $groupDetailEloq->save();
            }
            DB::commit();
            //更新管理员组菜单权限缓存
            $backendSystemMenu = new BackendSystemMenu();
            $backendSystemMenu->createMenuDatas($id, $role);
            return msgOut(['group_name' => $datas->group_name]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \Exception('300105');
        }//end try
    }
}
