<?php

namespace App\Models\User\Logics;

use App\Lib\BaseCache;
use Illuminate\Support\Facades\DB;

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
        $accTypeParams = DB::table('frontend_users_accounts_types as fuat')
            ->leftJoin(
                'frontend_users_accounts_types_params as fuatp',
                static function ($join): void {
                    $join->whereRaw('find_in_set(fuatp.id, fuat.param)');
                },
            )->select('fuat.*', DB::raw('GROUP_CONCAT(fuatp.param) as param'))
            ->where('sign', $sType)
            ->groupBy(DB::raw('fuat.id'))->pluck('param');
        $params        = explode(',', $accTypeParams[0]);
        $paramsFlipped = array_flip($params);
        $data          = array_fill_keys(array_keys($paramsFlipped), 'required');
        return $data;
    }
}
