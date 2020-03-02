<?php

namespace App\Services;

use App\Models\Game\GameVendor;
use Illuminate\Support\Str;

/**
 * Class FactoryService
 * @package App\Services
 */
class FactoryService
{

    /**
     * @var FactoryService $instence
     */
    private static $instence;

    /**
     * @var array $container
     */
    private static $container;

    /**
     * 采用单例模式.
     *
     * @return FactoryService
     */
    public static function getInstence(): FactoryService
    {
        if (!isset(self::$instence)) {
            self::$instence = new self();
        }
        return self::$instence;
    }

    /**
     * 获取处理支付的实例.
     *
     * @param string $platform Platform.
     * @param string $channel  Channel.
     * @return object
     */
    public function generatePay(string $platform, string $channel): object
    {
        $platform    = ucfirst(Str::camel($platform));
        $channel     = ucfirst(Str::camel($channel));
        $className   = 'App\Finance\Pay\\' . $platform . 'Platform\\' . $channel . 'Pay';
        $payInstence = self::_generateClass($className);
        return $payInstence;
    }

    /**
     * 获取服务类实例.
     *
     * @param string $service Service.
     * @return object
     */
    public function generateService(string $service): object
    {
        $className       = 'App\Services\\' . ucfirst($service) . 'Service';
        $serviceInstence = self::_generateClass($className);
        return $serviceInstence;
    }

    /**
     * 获取游戏类实例.
     *
     * @param GameVendor|null $vendor 厂商信息.
     * @return mixed
     */
    public function generateGame(?GameVendor $vendor)
    {
        if ($vendor !== null) {
            $className    = 'App\Game\\' . ucfirst($vendor->sign) . '\\' . ucfirst($vendor->sign) . 'Game';
            $gameInstence = self::_generateGameClass($className, $vendor);
            return $gameInstence;
        }
        return false;
    }

    /**
     * 获取对象实例.
     *
     * @param string     $className ClassName.
     * @param GameVendor $vendor    厂商信息.
     * @return object
     */
    private static function _generateGameClass(
        string $className,
        GameVendor $vendor
    ): object {
        // 采用对象池模式 对已存在的对象不再从新创建 以减少内存的开销
        if (!isset(self::$container[$className])) {
            self::$container[$className] = new $className($vendor);
        }
        return self::$container[$className];
    }

    /**
     * 获取对象实例.
     *
     * @param string $className ClassName.
     * @return object
     */
    private static function _generateClass(string $className): object
    {
        // 采用对象池模式 对已存在的对象不再从新创建 以减少内存的开销
        if (!isset(self::$container[$className])) {
            self::$container[$className] = new $className();
        }
        return self::$container[$className];
    }

    /**
     * 私有化 __clone 方法 禁止克隆
     * @return void
     */
    private function __clone()
    {
        //临时性为了避免克隆
    }
}
