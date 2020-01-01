<?php

namespace App\Lib;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

trait BaseCache
{

    /**
     * 获取tags缓存
     * @param string $cacheKey 缓存键.
     * @return mixed
     */
    public static function getTagsCacheData(string $cacheKey): mixed
    {
        $data = [];
        if (self::hasTagsCache($cacheKey)) {
            $cacheConfig = self::getCacheConfig($cacheKey);
            $data        = Cache::tags($cacheConfig['tags'])->get($cacheConfig['key'], []);
        }
        return $data;
    }

    /**
     * 保存tags缓存
     * @param  string $cacheKey 缓存键.
     * @param  mixed  $value    缓存值.
     * @return void
     */
    public static function saveTagsCacheData(string $cacheKey, $value): void
    {
        $cacheConfig = self::getCacheConfig($cacheKey);
        if (empty($cacheConfig) || !isset($cacheConfig['tags'], $cacheConfig['key'])) {
            return;
        }
        if ($cacheConfig['expire_time'] <= 0) {
            Cache::tags($cacheConfig['tags'])->forever($cacheConfig['key'], $value);
        } else {
            $expireTime = Carbon::now()->addSeconds($cacheConfig['expire_time']);
            Cache::tags($cacheConfig['tags'])->put($cacheConfig['key'], $value, $expireTime);
        }
    }

    /**
     * 删除tags缓存
     * @param  string $cacheKey 缓存键.
     * @return boolean
     */
    public static function deleteTagsCache(string $cacheKey): bool
    {
        $cacheConfig = self::getCacheConfig($cacheKey);
        if (!empty($cacheConfig) && isset($cacheConfig['tags'], $cacheConfig['key'])) {
            $forgetCache = Cache::tags($cacheConfig['tags'])->forget($cacheConfig['key']);
            return $forgetCache;
        }
        return false;
    }

    /**
     * 获取缓存配置
     * @param  string $cacheKey 缓存键.
     * @return mixed
     */
    public static function getCacheConfig(string $cacheKey)
    {
        $cacheConfig = config('web.main.cache');
        $configData  = $cacheConfig[$cacheKey] ?? [];
        return $configData;
    }

    /**
     * 检查是否存在tags缓存
     * @param  string $cacheKey 缓存键.
     * @return boolean
     */
    public static function hasTagsCache(string $cacheKey): bool
    {
        $cacheConfig = self::getCacheConfig($cacheKey);
        if (!empty($cacheConfig) && isset($cacheConfig['tags'], $cacheConfig['key'])) {
            $hasTagsCache = Cache::tags($cacheConfig['tags'])->has($cacheConfig['key']);
            return $hasTagsCache;
        }
        return false;
    }
}
