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
    public static function getTagsCacheData(string $cacheKey)
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
     * @param string $cacheKey 缓存键.
     * @param array  $data     缓存值.
     * @return array<string,mixed>|boolean
     */
    public static function appendArrTagsCache(string $cacheKey, array $data)
    {
        if (!$data) {
            return false;
        }
        if (self::hasTagsCache($cacheKey)) {
            $originalData = self::getTagsCacheData($cacheKey);
            $data         = array_merge($originalData, $data);//用最后数据覆盖之前的数据 如果没有用最后数据 合并到之前数据
        }
        self::saveTagsCacheData($cacheKey, $data);
        return $data;
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
            return Cache::tags($cacheConfig['tags'])->forget($cacheConfig['key']);
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
        return $cacheConfig[$cacheKey] ?? [];
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
            return Cache::tags($cacheConfig['tags'])->has($cacheConfig['key']);
        }
        return false;
    }
}
