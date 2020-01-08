<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\ModelFilters\Admin\MerchantAdminAccessGroupFilter;
use App\ModelFilters\Admin\MerchantAdminAccessGroupsHasBackendSystemMenuFilter;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminAccessGroupsHasBackendSystemMenu;
use App\Models\Systems\SystemPlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * 站点配置
 */
class EditAction
{

    /**
     * Comment
     *
     * @var SystemPlatform
     */
    protected $model;

    /**
     * @param SystemPlatform $systemPlatform 代理商平台.
     */
    public function __construct(SystemPlatform $systemPlatform)
    {
        $this->model = $systemPlatform;
    }

    /**
     * @param array $inputDatas 接收的参数.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        DB::beginTransaction();
        $platformELoq = $this->model->find($inputDatas['id']);
        if ($platformELoq === null) {
            DB::rollback();
            throw new \Exception('302004');
        }
        //基本信息修改
        $platformELoq->agency_method = $inputDatas['agency_method'];
        $platformELoq->start_time    = $inputDatas['start_time'];
        $platformELoq->end_time      = $inputDatas['end_time'];
        if (isset($inputDatas['sms_num']) && isset($inputDatas['type'])) {
            if ((int) $inputDatas['type'] === 0) {
                $platformELoq->sms_num -= $inputDatas['sms_num'];
                if ($platformELoq->sms_num < 0) {
                    $platformELoq->sms_num = 0;
                }
            } elseif ((int) $inputDatas['type'] === 1) {
                $platformELoq->sms_num += $inputDatas['sms_num'];
            }
        }
        if (!$platformELoq->save()) {
            DB::rollback();
            throw new \Exception('302004');
        }
        //权限修改
        $role = json_decode($inputDatas['role'], true);
        if (is_array($role)) {
            $editRole = $this->_editRole($platformELoq->sign, $role);
            if ($editRole === false) {
                DB::rollback();
                throw new \Exception('302005');
            }
        }
        DB::commit();
        $msgOut = msgOut(true);
        return $msgOut;
    }

    /**
     * 权限方面的修改
     * @param string $sign 平台标识.
     * @param array  $role 权限.
     * @return boolean
     */
    private function _editRole(string $sign, array $role): bool
    {
        $filterArr  = [
            'platform' => $sign,
            'super'    => MerchantAdminAccessGroup::IS_SUPER,
        ];
        $adminGroup = MerchantAdminAccessGroup::filter($filterArr, MerchantAdminAccessGroupFilter::class)->first();
        $oldRole    = $adminGroup->detail->pluck('menu_id')->toArray();
        //需要删除的权限
        $deleteRole = array_diff($oldRole, $role);
        if (!empty($deleteRole)) {
            $deleteRole = $this->_deleteRole($adminGroup->id, $deleteRole);
            if ($deleteRole === 0) {
                return false;
            }
        }
        //需要添加的权限
        $addRole = array_diff($role, $oldRole);
        if (!empty($addRole)) {
            $addRole = $this->_addRole($adminGroup->id, $addRole);
            return $addRole;
        }
        return true;
    }

    /**
     * 删除权限
     * @param integer $groupId    平台超管组的ID.
     * @param array   $deleteRole 权限菜单ID.
     * @return integer
     */
    private function _deleteRole(int $groupId, array $deleteRole): int
    {
        $filterArr  = [
            'groupId' => $groupId,
            'menuIn'  => $deleteRole,
        ];
        $deleteRole = MerchantAdminAccessGroupsHasBackendSystemMenu::
            filter($filterArr, MerchantAdminAccessGroupsHasBackendSystemMenuFilter::class)
            ->delete();
        return $deleteRole;
    }

    /**
     * 添加权限
     * @param integer $groupId 平台超管组的ID.
     * @param array   $roles   权限菜单ID.
     * @return boolean
     */
    private function _addRole(int $groupId, array $roles): bool
    {
        foreach ($roles as $menuId) {
            $addData  = [
                'group_id' => $groupId,
                'menu_id'  => $menuId,
            ];
            $roleEloq = new MerchantAdminAccessGroupsHasBackendSystemMenu();
            $roleEloq->fill($addData);
            if (!$roleEloq->save()) {
                return false;
            }
        }
        return true;
    }
}
