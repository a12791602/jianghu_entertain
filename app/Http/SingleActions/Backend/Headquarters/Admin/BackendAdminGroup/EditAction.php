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
 * Class for edit action.
 */
class EditAction
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
     * @param  BackEndApiMainController $contll     Controller.
     * @param  array                    $inputDatas 传递的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        $id = $inputDatas['id'];
        if ((int) $id === 1) {
            throw new \Exception('300101');
        }
        $datas = $this->model::find($id);
        if ($datas === null) {
            throw new \Exception('300100');
        }
        DB::beginTransaction();
        try {
            $datas->group_name = $inputDatas['group_name'];
            $datas->save();
            //只提取当前登录管理员也拥有的权限
            BackendAdminAccessGroupDetail::where('group_id', $id)->delete();
            $role = Arr::wrap(json_decode($inputDatas['role'], true));
            $role = array_intersect($contll->adminAccessGroupDetail, $role);
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
            $msgOut = msgOut(true, $datas->toArray());
            return $msgOut;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw new \Exception('300105');
        }
    }
}
