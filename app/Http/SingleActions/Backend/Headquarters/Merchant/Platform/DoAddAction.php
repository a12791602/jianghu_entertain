<?php

namespace App\Http\SingleActions\Backend\Headquarters\Merchant\Platform;

use App\Http\SingleActions\MainAction;
use App\Models\Admin\MerchantAdminAccessGroup;
use App\Models\Admin\MerchantAdminAccessGroupsHasBackendSystemMenu;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Finance\SystemBank;
use App\Models\Finance\SystemPlatformBank;
use App\Models\Systems\SystemConfiguration;
use App\Models\Systems\SystemConfigurationStandard;
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
class DoAddAction extends MainAction
{
    
    /**
     * @var SystemPlatform
     */
    private $platformEloq;

    /**
     * @param array $inputDatas 传递的参数.
     * @throws \Exception Exception.
     * @return JsonResponse
     */
    public function execute(array $inputDatas): JsonResponse
    {
        DB::beginTransaction();
        //生成平台
        $this->_createPlatform($inputDatas, $this->user->id);
        //生成平台加密数据用的证书
        $this->_createSSL();
        //生成平台默认配置
        $this->_createConfig();
        //平台绑定域名
        $this->_createPlatformDomain($inputDatas['domains'], $this->user->id);
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
        $msgOut = msgOut(['platform_name' => $inputDatas['platform_name']]);
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
                               'cn_name'        => $inputDatas['platform_name'],
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
        $config            = config('web.ssl.rule');
        $sslFirst          = $this->_getSSL($config);
        $sslSecond         = $this->_getSSL($config);
        $addData           = [
                              'platform_sign'       => $this->platformEloq->sign,
                              'private_key_first'   => $sslFirst['private_key'],
                              'public_key_first'    => $sslFirst['public_key'],
                              'interval_str_first'  => $sslFirst['interval_str'],
                              'private_key_second'  => $sslSecond['private_key'],
                              'public_key_second'   => $sslSecond['public_key'],
                              'interval_str_second' => $sslSecond['interval_str'],
                             ];
        $systemPlatformSsl = new SystemPlatformSsl();
        $systemPlatformSsl->fill($addData);
        if (!$systemPlatformSsl->save()) {
            throw new \Exception('300716');
        }
    }

    /**
     * get a ssl
     * @param  array $config SSL生成配置.
     * @throws \Exception Exception.
     * @return mixed[]
     */
    private function _getSSL(array $config): array
    {
        $resourse = openssl_pkey_new($config); //返回pkey的资源标识符:   OpenSSL key resource @12
        if ($resourse === false) {
            DB::rollback();
            throw new \Exception('300715');
        }
        openssl_pkey_export($resourse, $privateKey);
        $publicKey = openssl_pkey_get_details($resourse);
        if ($publicKey === false) {
            DB::rollback();
            throw new \Exception('300715');
        }
        $data = [
                 'private_key'  => $privateKey,
                 'public_key'   => $publicKey['key'],
                 'interval_str' => Str::random(11),
                ];
        return $data;
    }

    /**
     * 生成平台系统默认配置
     * @throws \Exception Exception.
     * @return void
     */
    private function _createConfig(): void
    {
        $platformSign = $this->platformEloq->sign;
        //生成父级配置
        $parentConfigs = SystemConfigurationStandard::where('pid', 0)->get();
        foreach ($parentConfigs as $parentConfig) {
            $parentData                  = $parentConfig->toArray();
            $configEloq                  = new SystemConfiguration();
            $parentData['platform_sign'] = $platformSign;
            unset($parentData['id']);
            $configEloq->fill($parentData);
            if (!$configEloq->save()) {
                DB::rollback();
                throw new \Exception('300717');
            }
            //生成子级配置
            $childConfigs = SystemConfigurationStandard::where('pid', $parentConfig->id)->get();
            foreach ($childConfigs as $childConfig) {
                $childData                  = $childConfig->toArray();
                $childEloq                  = new SystemConfiguration();
                $childData['platform_sign'] = $platformSign;
                $childData['pid']           = $configEloq->id;
                unset($childData['id']);
                $childEloq->fill($childData);
                if (!$childEloq->save()) {
                    DB::rollback();
                    throw new \Exception('300717');
                }
            }
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
