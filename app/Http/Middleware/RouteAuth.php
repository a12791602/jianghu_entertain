<?php

namespace App\Http\Middleware;

use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use App\Models\DeveloperUsage\Frontend\SystemRoutesH5;
use App\Models\DeveloperUsage\Frontend\SystemRoutesMobile;
use App\Models\DeveloperUsage\Frontend\SystemRoutesWeb;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use App\Models\Systems\SystemPlatform;
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
     * 对应model
     * @var array
     */
    protected $routeModel = [
        'app-api'          => SystemRoutesMobile::class,
        'h5-api'           => SystemRoutesH5::class,
        'pc-api'           => SystemRoutesWeb::class,
        'merchant-api'     => SystemRoutesMerchant::class,
        'headquarters-api' => SystemRoutesBackend::class,
    ];

    /**
     * @var array
     */
    protected $headquarters = [
        'portPrefix'    => 'headquarters-api',
        'current_guard' => 'backend',
        'route'         => SystemRoutesBackend::class,
        'menu'          => BackendSystemMenu::class,
    ];

    /**
     * @var array
     */
    protected $merchant = [
        'portPrefix'    => 'merchant-api',
        'current_guard' => 'merchant',
        'route'         => SystemRoutesMerchant::class,
        'menu'          => MerchantSystemMenu::class,
        'platform'      => SystemPlatform::class,
    ];

    /**
     * Model
     * @var object
     */
    protected $webModel;

    /**
     * 对应的看守器
     * @var array
     */
    protected $routeGuard = [
        'app-api'          => 'frontend-mobile',
        'pc-api'           => 'frontend-pc',
        'h5-api'           => 'frontend-h5',
        'merchant-api'     => 'merchant',
        'headquarters-api' => 'backend',
    ];

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
        'backend'  => [
            'merchant-api',
            'headquarters-api',
        ],
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
        $open_api_whitelists = config('open-api-whitelists.ip');
        $requestIp           = $request->ip();
        $isWhiteLists        = in_array($requestIp, $open_api_whitelists, true);
        $allowStatus         = $this->userAgent->isRobot() && !$isWhiteLists;
        $prefixes            = trim($request->route()->getPrefix(), '/');
        $prefixArr           = explode('/', $prefixes);
        if ($prefixArr !== false) {
            $prefix = $prefixArr[0];
        }
        if ($allowStatus) {
            Log::info('robot attacks: ' . json_encode($request->all()) . json_encode($request->header()));
            throw new Exception('100100');
        }
        if (!isset($this->routeModel[$prefix])) {
            throw new Exception('100003');
        }

        $this->webModel = new $this->routeModel[$prefix]();
        $this->guard    = $this->routeGuard[$prefix];
        $route          = $this->webModel::where('is_open', 0)->pluck('method')->toArray();
        $action         = explode('@', $request->route()->action['controller']);
        $auth_check     = in_array($action[1], $route);

        if ($auth_check) {
            if (!auth()->guard($this->guard)->check()) {
                throw new Exception('100004');
            }
        }

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
