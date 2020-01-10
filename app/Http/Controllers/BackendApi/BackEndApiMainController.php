<?php

namespace App\Http\Controllers\BackendApi;

use App\Http\Controllers\Controller;
use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use App\Models\Systems\SystemPlatform;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

/**
 * 总后台继承的控制器
 */
class BackEndApiMainController extends Controller
{

    /**
     * 传递的参数
     * @var array $inputs
     */
    public $inputs;

    /**
     * 当前的商户用户
     * @var object $currentAdmin
     */
    public $currentAdmin;

    /**
     * 当前商户存在的平台
     * @var object $currentPlatformEloq
     */
    public $currentPlatformEloq;

    /**
     * 目前路由
     * @var object $currentOptRoute
     */
    protected $currentOptRoute;

    /**
     * 当前商户的权限组
     * @var object $currentAccessAdminGroup
     */
    public $currentAccessAdminGroup;

    /**
     * 当前商户的权限
     * @var array $adminAccessGroupDetail
     */
    public $adminAccessGroupDetail = [];

    /**
     * 所有的菜单
     * @var array $fullMenuLists
     */
    protected $fullMenuLists;

    /**
     * 目前所有的菜单为前端展示用的
     * @var array $menuLists
     */
    protected $menuLists;

    /**
     * 当前的路由名称
     * @var string $currentRouteName
     */
    protected $currentRouteName;

    /**
     * 路由权限
     * @var boolean $routeAccessable
     */
    protected $routeAccessable = false;

    /**
     * 当前的logId
     * @var string $log_uuid
     */
    public $log_uuid;

    /**
     * @var object $currentAuth
     */
    public $currentAuth;

    /**
     * @var object $userAgent
     */
    public $userAgent;

    /**
     * @var array
     */
    protected $headquarters = [
        'portPrefix' => 'headquarters-api',
        'current_guard' => 'backend',
        'route' => SystemRoutesBackend::class,
        'menu' => BackendSystemMenu::class,
    ];

    /**
     * @var array
     */
    protected $merchant = [
        'portPrefix' => 'merchant-api',
        'current_guard' => 'merchant',
        'route' => SystemRoutesMerchant::class,
        'menu' => MerchantSystemMenu::class,
        'platform' => SystemPlatform::class,
    ];

    /**
     * @var array
     */
    protected $port = [];

    /**
     * @var boolean
     */
    private $constructorExist = false;

    /**
     * AdminMainController constructor.
     */
    public function __construct()
    {
        $this->_initial();
    }

    /**
     * @return void
     * @throws \Exception Exception.
     */
    private function _initial(): void
    {
        $this->_getport();
        if ($this->constructorExist === false) {
            return;
        }
        $this->_handleEndUser();
        $this->middleware(
            function ($request, $next) {
                $this->currentAuth  = auth($this->port['current_guard']);
                $this->currentAdmin = $this->currentAuth->user();
                if ($this->currentAdmin !== null) {
                    //登录注册的时候是没办法获取到当前用户的相关信息所以需要过滤
                    if ($this->currentAdmin->accessGroup()->exists()) {
                        $this->currentAccessAdminGroup = $this->currentAdmin->accessGroup;
                        $this->adminAccessGroupDetail  = $this->currentAccessAdminGroup
                            ->detail
                            ->pluck('menu_id')
                            ->toArray();
                    }
                    $this->_menuAccess();
                    $this->_routeAccessCheck();
                    if ($this->routeAccessable === false) {
                        throw new \Exception('100001');
                    }
                    if ($this->port['portPrefix'] === 'merchant-api') {
                        $this->currentPlatformEloq = $this->currentAdmin->platform;
                    }
                    $this->inputs = Request::all();
                }
                //获取所有相关的传参数据
                $this->_adminOperateLog(); //登录注册的时候是没办法获取到当前用户的相关信息所以需要过滤
                return $next($request);
            },
        );
    }

    /**
     * 获取当前接口所属端口
     *
     * @return void
     * @throws \Exception Exception.
     */
    private function _getport(): void
    {
        $this->currentOptRoute = Route::getCurrentRoute();
        if (empty($this->currentOptRoute)) {
            return;
        }

        $prefix   = trim($this->currentOptRoute->getPrefix(), '/');
        $routeArr = explode('/', $prefix);
        if (!is_array($routeArr)) {
            return;
        }

        $portPrefix = $routeArr[0];
        if ($portPrefix === 'headquarters-api') {
            $this->_constructorExist();
            $this->port = $this->headquarters;
        } elseif ($portPrefix === 'merchant-api') {
            $this->_constructorExist();
            $this->port = $this->merchant;
        } else {
            throw new \Exception('302200');
        }
    }

    /**
     * @return void
     */
    private function _constructorExist(): void
    {
        $this->constructorExist = true;
    }

    /**
     * 处理客户端
     *
     * @return void
     */
    private function _handleEndUser(): void
    {
        $open_api_whitelists = Config::get('open-api-whitelists.ip');
        $requestIp           = Request::ip();
        $this->userAgent     = new Agent();
        $isRobot             = $this->userAgent->isRobot();
        $isWhiteLists        = Request::header('from') === 'Lottery Center System v3.0.0.0' ||
            in_array($requestIp, $open_api_whitelists, true);
        $allowStatus         = $isRobot && !$isWhiteLists;
        if ($allowStatus) {
            $inputToLog   = json_encode(Request::all(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512);
            $headersToLog = json_encode(Request::header(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512);
            Log::info('robot attacks: ' . $inputToLog . $headersToLog);
            // echo '机器人禁止操作';
            die();
        }
        $systemRouteELoq = new $this->port['route']();
        $open_route      = $systemRouteELoq->where('is_open', 1)->pluck('method')->toArray();
        $this->middleware('auth:' . $this->port['current_guard'], ['except' => $open_route]);
    }

    /**
     * 初始化所有菜单，目前商户该拥有的菜单与权限
     *
     * @return void
     */
    private function _menuAccess(): void
    {
        $menuEloq            = new $this->port['menu']();
        $this->fullMenuLists = $menuEloq->forStar(); //所有的菜单
        //目前所有的菜单为前端展示用的
        $this->menuLists = $menuEloq->getUserMenuDatas(
            $this->currentAccessAdminGroup->id,
            $this->adminAccessGroupDetail,
        );
    }

    /**
     * 检测目前的路由是否有权限访问
     *
     * @return void
     */
    private function _routeAccessCheck(): void
    {
        $this->currentRouteName = $this->currentOptRoute->action['as']; //当前的route name;
        $routeEloq              = new $this->port['route']();
        $routeEloq              = $routeEloq->where('route_name', $this->currentRouteName)->first();
        if (empty($routeEloq)) {
            return;
        }
        if (!$routeEloq->menu) {
            return;
        }
        $this->_accessGroupCheck($routeEloq->menu);
    }

    /**
     * 检查权限
     * @param mixed $menuEloq 菜单Eloq.
     * @return void
     */
    private function _accessGroupCheck($menuEloq): void
    {
        if (!in_array($menuEloq->id, $this->adminAccessGroupDetail)) {
            return;
        }
        $this->routeAccessable = true;
    }

    /**
     * 记录后台管理员操作日志
     * @return void
     */
    private function _adminOperateLog(): void
    {
        $this->log_uuid = Str::orderedUuid()->getNodeHex();
        $datas          = [
            'input' => $this->inputs,
            'route' => $this->currentOptRoute,
            'log_uuid' => $this->log_uuid,
        ];
        $logData        = json_encode($datas, JSON_UNESCAPED_UNICODE);
        Log::channel('apibyqueue')->info($logData);
    }
}
