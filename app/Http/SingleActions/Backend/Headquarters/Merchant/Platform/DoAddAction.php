<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\Controllers\BackendApi\BackEndApiMainController;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminAccessGroupsHasBackendSystemMenu;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Finance\SystemBank;
use App\Models\Finance\SystemPlatformBank;
use App\Models\Systems\SystemDomain;
use App\Models\Systems\SystemPlatform;
use App\Models\Systems\SystemPlatformSsl;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class for merchant admin user do add action .
 */
class DoAddAction
{
    
    /**
     * @var SystemPlatform
     */
    private $platformEloq;

    /**
     * @param BackEndApiMainController $contll     Controller.
     * @param array                    $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(BackEndApiMainController $contll, array $inputDatas): JsonResponse
    {
        DB::beginTransaction();
        //生成平台
        $this->_createPlatform($inputDatas, $contll->currentAdmin->id);
        //生成平台加密数据用的证书
        $this->_createSSL();
        //平台绑定域名
        $this->_createPlatformDomain($inputDatas['domains'], $contll->currentAdmin->id);
        //生成平台银行配置
        $this->_createBanks();
        //生成超级管理员组
        $adminGroupEloq = $this->_createAdminGroup();
        //生成管理员组权限
        $this->_createGroupRole($inputDatas, $adminGroupEloq->id);
        //生成运营商帐号
        $adminUser = $this->_createAdminUser($inputDatas, $adminGroupEloq->id);
        //插入平台所属人id
        $this->_editPlatformOwner($adminUser->id);
        //完成
        DB::commit();
        $msgOut = msgOut(true, ['platform_name' => $inputDatas['platform_name']]);
        return $msgOut;
    }

    /**
     * Creates a platform.
     *
     * @param array   $inputDatas 接收的参数.
     * @param integer $adminId    管理员ID.
     * @throws \Exception Exception.
     * @return void
     */
    private function _createPlatform(array $inputDatas, int $adminId): void
    {
        $this->platformEloq = new SystemPlatform();
        $platformData       = [
                               'name'           => $inputDatas['platform_name'],
                               'sign'           => $inputDatas['platform_sign'],
                               'agency_method'  => $inputDatas['agency_method'],
                               'start_time'     => $inputDatas['start_time'],
                               'end_time'       => $inputDatas['end_time'],
                               'sms_num'        => $inputDatas['sms_num'],
                               'author_id'      => $adminId,
                               'last_editor_id' => $adminId,
                              ];
        $this->platformEloq->fill($platformData);
        if (!$this->platformEloq->save()) {
            DB::rollback();
            throw new \Exception('300708');
        }
    }

    /**
     * Creates a ssl.
     * @throws \Exception Exception.
     * @return void
     */
    private function _createSSL(): void
    {
        $config   = config('web.ssl.rule');
        $resourse = openssl_pkey_new($config); //返回pkey的资源标识符:   OpenSSL key resource @12
        if ($resourse === false) {
            DB::rollback();
            throw new \Exception('300715');
        }
        openssl_pkey_export($resourse, $privateKey);
        $publicKey         = openssl_pkey_get_details($resourse);
        $publicKey         = $publicKey['key'];
        $intervalStr       = Str::random(11);
        $addData           = [
                              'platform_sign' => $this->platformEloq->sign,
                              'private_key'   => $privateKey,
                              'public_key'    => $publicKey,
                              'interval_str'  => $intervalStr,
                             ];
        $systemPlatformSsl = new SystemPlatformSsl();
        $systemPlatformSsl->fill($addData);
        if (!$systemPlatformSsl->save()) {
            throw new \Exception('300716');
        }
    }

    /**
     * Creates a platform domain.
     *
     * @param array   $domains 添加的域名.
     * @param integer $adminId 平台标识.
     * @throws \Exception Exception.
     * @return void
     */
    private function _createPlatformDomain(array $domains, int $adminId): void
    {
        foreach ($domains as $domain) {
            $systemDomainELoq = new SystemDomain();
            $insertDomain     = $systemDomainELoq->insertAllTypeDomain($domain, $this->platformEloq->sign, $adminId);
            if ($insertDomain !== true) {
                DB::rollback();
                throw new \Exception('300709');
            }
        }
    }

    /**
     * @throws \Exception Exception.
     * @return void
     */
    private function _createBanks(): void
    {
        $systemBank = SystemBank::pluck('id')->toArray();
        $addData    = [
                       'platform_sign' => $this->platformEloq->sign,
                       'status'        => SystemPlatformBank::STATUS_CLOSE,
                      ];

        foreach ($systemBank as $bankId) {
            $addData['bank_id'] = $bankId;
            $systemPlatformBank = new SystemPlatformBank();
            $systemPlatformBank->fill($addData);
            if (!$systemPlatformBank->save()) {
                DB::rollback();
                throw new \Exception('300710');
            }
        }
    }

    /**
     * Creates an admin group.
     *
     * @throws \Exception Exception.
     * @return MerchantAdminAccessGroup
     */
    private function _createAdminGroup(): MerchantAdminAccessGroup
    {
        $adminGroupEloq = new MerchantAdminAccessGroup();
        $adminGroupData = [
                           'group_name'    => '超级管理',
                           'platform_sign' => $this->platformEloq->sign,
                           'is_super'      => MerchantAdminAccessGroup::IS_SUPER,
                          ];
        $adminGroupEloq->fill($adminGroupData);
        if (!$adminGroupEloq->save()) {
            DB::rollback();
            throw new \Exception('300711');
        }
        return $adminGroupEloq;
    }

    /**
     * Creates a group role.
     *
     * @param array   $inputDatas   接收的参数.
     * @param integer $adminGroupId 管理员角色组ID.
     * @throws \Exception Exception.
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
            if (!$roleEloq->save()) {
                DB::rollback();
                throw new \Exception('300712');
            }
        }
    }

    /**
     * Creates an admin user.
     *
     * @param array   $inputDatas   接收的参数.
     * @param integer $adminGroupId 管理员角色组ID.
     * @throws \Exception Exception.
     * @return MerchantAdminUser
     */
    private function _createAdminUser(array $inputDatas, int $adminGroupId): MerchantAdminUser
    {
        $adminData         = [
                              'name'     => 'admin',
                              'email'    => $inputDatas['email'],
                              'password' => bcrypt($inputDatas['password']),
                              'group_id' => $adminGroupId,
                             ];
        $merchantAdminUser = new MerchantAdminUser();
        $merchantAdminUser->fill($adminData);
        if (!$merchantAdminUser->save()) {
            DB::rollback();
            throw new \Exception('300713');
        }
        return $merchantAdminUser;
    }

    /**
     * @param integer $adminUserId 平台所属超级管理员ID.
     * @throws \Exception Exception.
     * @return void
     */
    private function _editPlatformOwner(int $adminUserId): void
    {
        $this->platformEloq->owner_id = $adminUserId;
        if (!$this->platformEloq->save()) {
            throw new \Exception('300714');
        }
    }
}
