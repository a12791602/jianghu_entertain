<?php

namespace App\Models\User\Logics;

use App\Lib\BaseCache;
use App\Models\User\FrontendUsersAccountsTypesParam;

trait FrontendUsersAccountsTypeLogics
{
    use BaseCache;

    /**
     * 获取具体详情
     * @param string $sign 标识.
     * @return mixed
     */
    public static function getTypeBySign(string $sign)
    {
        $data = self::getDataListFromCache();
        return $data[$sign] ?? [];
    }

    /**
     * 获取所有配置
     * @return mixed
     */
    public static function getDataListFromCache()
    {
        $cacheKey = 'account_change_type';
        if (self::hasTagsCache($cacheKey)) {
            $data = self::getTagsCacheData($cacheKey);
        } else {
            $data = self::getDataFromDb();
            if ($data) {
                self::saveTagsCacheData($cacheKey, $data);
            }
        }
        return $data;
    }

    /**
     * 获取所有数据 无缓存
     * @return mixed[]
     */
    public static function getDataFromDb(): array
    {
        $items = self::orderBy('id', 'desc')->get();
        $data  = [];
        foreach ($items as $item) {
            $data[$item->sign] = $item->toArray();
        }
        return $data;
    }

    /**
     * @param string $sType 类型.
     * @return mixed[]
     */
    public static function getParamToTransmit(string $sType = ''): array
    {
        $data        = [];
        $accountType = self::where('sign', $sType)->first();
        if (!$accountType) {
            return $data;
        }
        $paramIds = explode(',', $accountType->param);
        if (!$paramIds) {
            return $data;
        }
        $params = FrontendUsersAccountsTypesParam::whereIn('id', $paramIds)->pluck('param')->toArray();
        if (empty($params)) {
            return $data;
        }
        $paramsFlipped = array_flip($params);
        return array_fill_keys(array_keys($paramsFlipped), 'required');
    }
}
