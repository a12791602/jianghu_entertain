<?php

namespace App\Models\Systems\Logics;

use Illuminate\Support\Facades\DB;

trait SystemDomainLogics
{

    /**
     * 插入所有类型的域名
     * @param  string  $domain       域名.
     * @param  string  $platformSign 平台标识.
     * @param  integer $adminId      管理员ID.
     * @return mixed
     */
    public function insertAllTypeDomain(string $domain, string $platformSign, int $adminId)
    {
        $typePrefix = $this->typePrefix;
        DB::beginTransaction();
        foreach ($typePrefix as $type => $prefix) {
            $addData = [
                        'platform_sign' => $platformSign,
                        'admin_id'      => $adminId,
                        'status'        => self::STATUS_OPEN,
                        'domain'        => $prefix . $domain,
                        'type'          => $type,
                       ];
            $result  = $this->insertDomain($addData);
            if ($result !== true) {
                DB::rollback();
                return $result;
            }
        }
        DB::commit();
        return true;
    }

    /**
     * 插入一条域名
     * @param array $addData 数据.
     * @return mixed
     */
    public function insertDomain(array $addData)
    {
        $isExists = $this->checkDomain($addData['domain']);
        if ($isExists) {
            return '302500';
        }
        $domainEloq = new self();
        $domainEloq->fill($addData);
        if (!$domainEloq->save()) {
            return '302501';
        }
        return true;
    }

    /**
     * 检查域名格式
     * @param  string  $domain 域名.
     * @param  integer $type   类型.
     * @return boolean
     */
    public function checkDomainPrefix(string $domain, int $type): bool
    {
        $success = false;
        $count   = mb_substr_count($domain, '.');
        if ($count === 1) {
            //主域名
            $success = true;
        } elseif ($count === 2) {
            //二级域名
            $prefix     = substr($domain, 0, strpos($domain, '.') + 1);
            $typePrefix = $this->typePrefix;
            //检查域名前缀是否正确
            if ($typePrefix[$type] === $prefix) {
                $success = true;
            }
        }
        return $success;
    }

    /**
     * 域名是否存在
     * @param  string $domain 域名.
     * @return boolean
     */
    public function checkDomain(string $domain): bool
    {
        $isExists = $this->where('domain', $domain)->exists();
        return $isExists;
    }
}
