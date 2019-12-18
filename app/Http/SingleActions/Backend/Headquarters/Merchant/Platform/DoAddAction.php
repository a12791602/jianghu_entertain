<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\Controllers\BackendApi\Headquarters\BackEndApiMainController;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminAccessGroupsHasBackendSystemMenu;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Finance\SystemBank;
use App\Models\Finance\SystemPlatformBank;
use App\Models\Systems\SystemDomain;
use App\Models\Systems\SystemPlatform;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class for merchant admin user do add action .
 */
class DoAddAction
{
    /**
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 传递的参数.
     * @throws \Exception               Exception.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        DB::beginTransaction();
        try {
            //生成平台
            $platformEloq = $this->_createPlatform($inputDatas, $contll->currentAdmin->id);
            //平台绑定域名
            $this->_createPlatformDomain($inputDatas['domains'], $platformEloq->sign, $contll->currentAdmin->id);
            //生成平台银行配置
            $this->_createBanks($platformEloq->sign);
            //生成超级管理员组
            $adminGroupEloq = $this->_createAdminGroup($platformEloq->sign);
            //生成管理员组权限
            $this->_createGroupRole($inputDatas, $adminGroupEloq->id);
            //生成运营商帐号
            $adminUser = $this->_createAdminUser($inputDatas, $adminGroupEloq->id);
            //插入平台所属人id
            $this->_editPlatformOwner($platformEloq, $adminUser->id);
            //完成
            DB::commit();
            $msgOut = msgOut(true, ['platform_name' => $inputDatas['platform_name']]);
            return $msgOut;
        } catch (\Throwable $e) {
            DB::rollback();
            throw new \Exception('300705');
        }
    }

    /**
     * Creates a platform.
     *
     * @param array   $inputDatas 接收的参数.
     * @param integer $adminId    管理员ID.
     * @return SystemPlatform
     */
    private function _createPlatform(array $inputDatas, int $adminId): SystemPlatform
    {
        $platformEloq = new SystemPlatform();
        $platformData = [
            'name'           => $inputDatas['platform_name'],
            'sign'           => $inputDatas['platform_sign'],
            'agency_method'  => $inputDatas['agency_method'],
            'author_id'      => $adminId,
            'last_editor_id' => $adminId,
            'start_time'     => $inputDatas['start_time'],
            'end_time'       => $inputDatas['end_time'],
        ];
        $platformEloq->fill($platformData);
        $platformEloq->save();
        return $platformEloq;
    }

    /**
     * Creates a platform domain.
     *
     * @param array   $domains      添加的域名.
     * @param string  $platformSign 平台标识.
     * @param integer $adminId      平台标识.
     * @return void
     */
    private function _createPlatformDomain(array $domains, string $platformSign, int $adminId): void
    {

        foreach ($domains as $domain) {
            $systemDomainELoq = new SystemDomain();
            $systemDomainELoq->insertAllTypeDomain($domain, $platformSign, $adminId);
        }
    }

    /**
     * @param string $platformSign 平台标识.
     * @return void
     */
    private function _createBanks(string $platformSign): void
    {
        $systemBank = SystemBank::pluck('id')->toArray();
        $addData    = [
            'platform_sign' => $platformSign,
            'status'        => SystemPlatformBank::STATUS_CLOSE,
        ];

        foreach ($systemBank as $bankId) {
            $addData['bank_id'] = $bankId;
            $systemPlatformBank = new SystemPlatformBank();
            $systemPlatformBank->fill($addData);
            $systemPlatformBank->save();
        }
    }

    /**
     * Creates an admin group.
     *
     * @param string $platformSign 平台标识.
     * @return MerchantAdminAccessGroup
     */
    private function _createAdminGroup(string $platformSign): MerchantAdminAccessGroup
    {
        $adminGroupEloq = new MerchantAdminAccessGroup();
        $adminGroupData = [
            'group_name'    => '超级管理',
            'platform_sign' => $platformSign,
            'is_super'      => MerchantAdminAccessGroup::IS_SUPER,
        ];
        $adminGroupEloq->fill($adminGroupData);
        $adminGroupEloq->save();
        return $adminGroupEloq;
    }

    /**
     * Creates a group role.
     *
     * @param array   $inputDatas   接收的参数.
     * @param integer $adminGroupId 管理员角色组ID.
     * @return void
     */
    private function _createGroupRole(array $inputDatas, int $adminGroupId): void
    {
        $role = Arr::wrap(json_decode($inputDatas['role'], true));

        foreach ($role as $menuId) {
            $roleData = [
                'group_id' => $adminGroupId,
                'menu_id'  => $menuId,
            ];
            $roleEloq = new MerchantAdminAccessGroupsHasBackendSystemMenu();
            $roleEloq->fill($roleData);
            $roleEloq->save();
        }
    }

    /**
     * Creates an admin user.
     *
     * @param array   $inputDatas   接收的参数.
     * @param integer $adminGroupId 管理员角色组ID.
     * @return MerchantAdminUser
     */
    private function _createAdminUser(array $inputDatas, int $adminGroupId): MerchantAdminUser
    {
        $adminData         = [
            'name'     => $inputDatas['username'],
            'email'    => $inputDatas['email'],
            'password' => bcrypt($inputDatas['password']),
            'group_id' => $adminGroupId,
        ];
        $merchantAdminUser = MerchantAdminUser::create($adminData);
        return $merchantAdminUser;
    }

    /**
     * @param SystemPlatform $platformEloq 平台eloq.
     * @param integer        $adminUserId  平台所属超级管理员ID.
     * @return void
     */
    private function _editPlatformOwner(SystemPlatform $platformEloq, int $adminUserId): void
    {
        $platformEloq->owner_id = $adminUserId;
        $platformEloq->save();
    }
}
