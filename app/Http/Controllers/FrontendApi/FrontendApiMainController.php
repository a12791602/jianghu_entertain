<?php

namespace App\Http\Controllers\FrontendApi;

use App\Http\Controllers\Controller;
use App\Models\DeveloperUsage\Frontend\SystemRoutesH5;
use App\Models\DeveloperUsage\Frontend\SystemRoutesMobile;
use App\Models\DeveloperUsage\Frontend\SystemRoutesWeb;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

/**
 * 前台继承的控制器
 */
class FrontendApiMainController extends Controller
{

    /**
     * 接收的参数
     * @var array $inputs
     */
    public $inputs;

    /**
     * 当前登录的用户
     * @var object $frontendUser App\Models\User\frontendUser
     */
    public $frontendUser;

    /**
     * 目前路由
     * @var object $currentOptRoute \Illuminate\Routing\Route
     */
    protected $currentOptRoute;

    /**
     * 当前用户存在的平台
     * @var object $currentPlatformEloq \App\Models\SystemPlatform
     */
    public $currentPlatformEloq;

    /**
     * 当前的logId
     * @var string $log_uuid
     */
    protected $log_uuid;

    /**
     * 当前的守卫名称
     * @var string $currentGuard
     */
    protected $currentGuard;

    /**
     * currentAuth
     * @var object $currentAuth
     */
    public $currentAuth;

    /**
     * Agent
     * @var object $userAgent
     */
    public $userAgent;

    /**
     * 对应model
     *
     * @var array
     */
    protected $routeModel = [
        'app-api' => SystemRoutesMobile::class,
        'h5-api' => SystemRoutesH5::class,
        'pc-api' => SystemRoutesWeb::class,
    ];

    /**
     * Model
     *
     * @var object
     */
    protected $webModel;

    /**
     * 对应的看守器
     *
     * @var array
     */
    protected $routeGuard = [
        'app-api' => 'frontend-mobile',
        'pc-api' => 'frontend-pc',
        'h5-api' => 'frontend-h5',
    ];

    /**
     * AdminMainController constructor.
     */
    public function __construct()
    {
        $this->_handleEndUser();
        $this->middleware(
            function ($request, $next) {
                $this->_userOperateLog();
                if (($this->frontendUser !== null) && $this->frontendUser->platform()->exists()) {
                    $this->currentPlatformEloq = $this->frontendUser->platform; //获取目前账号用户属于平台的对象
                }
                return $next($request);
            },
        );
    }

    /**
     * 处理客户端
     * @return void
     * @throws \Exception ThrowingError.
     */
    private function _handleEndUser(): void
    {
        $open_route = [];
        //登录注册的时候是没办法获取到当前用户的相关信息所以需要过滤
        $this->currentOptRoute = Route::getCurrentRoute();
        $prefix                = trim(Route::getCurrentRoute()->getPrefix(), '/');
        $this->userAgent       = new Agent();
        if ($this->userAgent->isRobot()) {
            Log::info('robot attacks: ' . json_encode(Request::all()) . json_encode(Request::header()));
            throw new \Exception('100000');
        }
        if (!isset($this->routeModel[$prefix])) {
            throw new \Exception('100003');
        }
        $this->webModel     = new $this->routeModel[$prefix]();
        $open_route         = $this->webModel::where('is_open', 1)->pluck('method')->toArray();
        $this->currentGuard = $this->routeGuard[$prefix];
        $this->middleware('auth:' . $this->currentGuard, ['except' => $open_route]);
    }

    /**
     * 记录后台管理员操作日志
     * @return void
     */
    private function _userOperateLog(): void
    {
        $this->inputs       = Request::all(); //获取所有相关的传参数据
        $this->currentAuth  = auth($this->currentGuard);
        $this->frontendUser = $this->currentAuth->user();
        $this->log_uuid     = Str::orderedUuid()->getNodeHex();
        $datas              = [
            'input' => $this->inputs,
            'route' => $this->currentOptRoute,
            'log_uuid' => $this->log_uuid,
        ];
        $logData            = json_encode($datas, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE, 512);
        Log::channel('frontend-by-queue')->info($logData);
    }
}
