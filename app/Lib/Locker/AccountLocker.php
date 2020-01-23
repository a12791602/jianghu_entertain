<?php

namespace App\Lib\Locker;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * cache 必须支持 tags
 * Class AccountLocker
 * @package App\Lib
 */
class AccountLocker
{

    /**
     * 缓存
     * @var string
     */
    protected $memKey = '';

    /**
     * @var string
     */
    protected $memValue = '';

    /**
     * @var string
     */
    protected $prefix = 'account_lock_';

    /**
     * @var array
     */
    protected $context = [];

    /**
     * 时间
     * @var integer
     */
    protected $cacheTimeout = 1; // 分钟

    /**
     * @var integer
     */
    protected $lockerTimeout = 6; // 秒

    /**
     * 睡眠时间 目前支持微妙  500毫秒
     * @var integer
     */
    protected $sleepSeconds = 500000;

    /**
     * @param integer $userId        用户ID.
     * @param integer $cacheTimeout  CacheTimeout.
     * @param integer $lockerTimeout LockerTimeout.
     * @param integer $sleepSeconds  SleepSeconds.
     */
    public function __construct(
        int $userId,
        int $cacheTimeout = 5,
        int $lockerTimeout = 15,
        int $sleepSeconds = 500000
    ) {
        $this->memKey        = $this->prefix . $userId;
        $this->memValue      = $userId . '_' . date('Y-m-d H:i:s');
        $this->cacheTimeout  = $cacheTimeout;
        $this->lockerTimeout = $lockerTimeout;
        $this->sleepSeconds  = $sleepSeconds;
    }


    /**
     * 获取锁
     * @return boolean
     */
    public function getLock(): bool
    {
        $time = time();
        while (time() - $time < $this->lockerTimeout) {
            if (Cache::tags(self::$tagName)->add($this->memKey, $this->memValue, $this->cacheTimeout)) {
                return true;
            }
            usleep($this->sleepSeconds);
        }
        Log::channel('log')->error('账户锁-获取锁失败-' . $this->memKey, $this->context);
        // 释放
        $this->release();
        return false;
    }

    /**
     * 释放当前
     * @return mixed
     * @throws \Exception Exception.
     */
    public function release()
    {
        try {
            $return = Cache::tags(self::$tagName)->forget($this->memKey);
        } catch (\Throwable $e) {
            Log::channel('log')->error('账户锁-释放锁失败-' . $e->getMessage(), $this->context);
            $return = false;
        }
        return $return;
    }

    /**
     * 上下文
     * @param array $context Context.
     * @return void
     */
    public function setContext(array $context): void
    {
        $this->context = $context;
    }

    /**
     * @var string
     */
    public static $tagName = 'account_lock';

    /**
     * 释放所有
     * @return void
     */
    public static function releaseAll(): void
    {
        Cache::tags(self::$tagName)->flush();
    }
}
