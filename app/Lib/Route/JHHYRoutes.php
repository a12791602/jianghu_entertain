<?php


namespace App\Lib\Route;

use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use App\Models\DeveloperUsage\Frontend\SystemRoutesH5;
use App\Models\DeveloperUsage\Frontend\SystemRoutesMobile;
use App\Models\DeveloperUsage\Frontend\SystemRoutesWeb;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use Exception;

/**
 * Class JHHYRoutes
 * @package App\Lib\Route
 */
class JHHYRoutes
{

    /**
     * 对应model
     * @var array
     */
    protected static $routeModel = [
                                    'app-api'          => SystemRoutesMobile::class,
                                    'h5-api'           => SystemRoutesH5::class,
                                    'pc-api'           => SystemRoutesWeb::class,
                                    'merchant-api'     => SystemRoutesMerchant::class,
                                    'headquarters-api' => SystemRoutesBackend::class,
                                   ];

    /**
     * 对应的看守器
     * @var array
     */
    protected static $routeGuard = [
                                    'app-api'          => 'frontend-mobile',
                                    'pc-api'           => 'frontend-pc',
                                    'h5-api'           => 'frontend-h5',
                                    'merchant-api'     => 'merchant',
                                    'headquarters-api' => 'backend',
                                   ];

    /**
     * 封装相关目前路由数据
     * @return array<string,mixed>
     * @throws Exception Exception.
     */
    public static function validateRoute(): array
    {
        $prefix = self::getRoutePrefix();
        if (!isset(self::$routeModel[$prefix])) {
            throw new Exception('100003');
        }
        $webModel        = new self::$routeModel[$prefix]();
        $guard           = self::$routeGuard[$prefix];
        $route           = $webModel::where('is_open', 0)->pluck('method')->toArray();
        $action          = self::getCurrentActionName();
        $auth_check      = in_array($action[1], $route);
        $exposure_status = self::getExposedStatus($action, $webModel);
        return [
                'prefix'          => $prefix,
                'guard'           => $guard,
                'auth_check'      => $auth_check,
                'exposure_status' => $exposure_status,
               ];
    }

    /**
     * 当前路由split 后台数组
     *
     * @return array<int,string>
     */
    public static function getRoutePrefixs(): array
    {
        $request  = request();
        $prefixes = trim($request->route()->getPrefix(), '/');
        return explode('/', $prefixes);
    }

    /**
     * get current prefix
     *
     * @return mixed
     */
    public static function getRoutePrefix()
    {
        $prefixArr = self::getRoutePrefixs();
        return $prefixArr[0];
    }

    /**
     * get current Action with array
     *
     * @return array<int,string>
     */
    public static function getCurrentActionName(): array
    {
        $request = request();
        return explode('@', $request->route()->getActionName());
    }

    /**
     * 是否是 回调等路由 提供给外部 使用 判断是否 需要加密
     *
     * @param array  $action   Action Controller name and Method name.
     * @param object $webModel Extracted WebModel Object.
     * @return integer
     */
    public static function getExposedStatus(array $action, object $webModel): int
    {
        $controller = $action[0];
        $method     = $action[1];
        $routeEloq  = $webModel::where(
            [
             [
              'controller',
              '=',
              $controller,
             ],
             [
              'method',
              '=',
              $method,
             ],
            ],
        )->first();//is_ack
        return $routeEloq->is_ack ?? 0;
    }
}
