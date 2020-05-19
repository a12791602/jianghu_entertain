<?php

namespace App\Http\Middleware;

use App\Lib\Route\JHHYRoutes;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

/**
 * Class RouteAuth
 * @package App\Http\Middleware
 */
class RouteAuth
{

    /**
     * 当前的守卫名称
     * @var string $guard
     */
    protected $guard;

    /**
     * Agent
     * @var Agent $userAgent
     */
    public $userAgent;

    /**
     * Log Channels
     * @var array Logger.
     */
    protected $logger = [
                         'frontend' => [
                                        'app-api',
                                        'pc-api',
                                        'h5-api',
                                       ],
                         'backend'  => ['headquarters-api'],
                         'merchant' => ['merchant-api'],
                        ];

    /**
     * RouteAuth constructor.
     */
    public function __construct()
    {
        $this->userAgent = new Agent();
    }

    /**
     * Handle an incoming request.
     * @param Request $request Request.
     * @param Closure $next    Next.
     * @return mixed
     * @throws Exception Exception.
     */
    public function handle(Request $request, Closure $next)
    {
        //###############检查ip 白名单 与 机器人 ###########################
        $open_api_whitelists = config('open-api-whitelists.ip');
        $requestIp           = $request->ip();
        $isWhiteLists        = in_array($requestIp, $open_api_whitelists, true);
        $allowStatus         = $this->userAgent->isRobot() && !$isWhiteLists;
        if ($allowStatus) {
            Log::info('robot attacks: ' . json_encode($request->all()) . json_encode($request->header()));
            throw new Exception('100100');
        }
        //###############  检查路由  ###########################
        $curRouteInfos = $request->get('currentRouteInfos');//在 crypt MiddleWare 中需要共用的数据 进行处理
        //总控时不会经过加密于是 这个参数会变空
        if ($curRouteInfos === null) {
            $curRouteInfos = JHHYRoutes::validateRoute();
        } else {
            $request->attributes->remove('currentRouteInfos');
        }
        $this->guard = $curRouteInfos['guard'];
        $prefix      = $curRouteInfos['prefix'];
        $auth_check  = $curRouteInfos['auth_check'];
        if ($auth_check) {
            if (!auth($this->guard)->check()) {
                throw new Exception('100004', 401);
            }
        }
        //######################################################################
        $request->setUserResolver(
            function () {
                return auth($this->guard)->user();
            },
        );

        foreach ($this->logger as $keys => $item) {
            $prefix_check = in_array($prefix, $item);
            if ($prefix_check) {
                $request->attributes->add(['logger' => $keys]);
                break;
            }
        }
        $request->attributes->add(['guard' => $this->guard, 'prefix' => $prefix]);
        return $next($request);
    }
}
