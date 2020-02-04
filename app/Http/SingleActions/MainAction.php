<?php

namespace App\Http\SingleActions;

use App\Models\DeveloperUsage\Backend\SystemRoutesBackend;
use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use App\Models\Systems\SystemPlatform;
use App\Services\Logs\SystemPublicLogService;
use Exception;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

/**
 * Class Frontend MainAction.
 * @package App\Http\SingleActions\Common\FrontendAuth
 */
class MainAction
{

    /**
     * User Agent
     * @var object $agent
     */
    protected $agent;

    /**
     * Get the available auth instance.
     * @var object $auth
     */
    protected $auth;

    /**
     * Get the currently authenticated user.
     * @var object $auth
     */
    protected $user;

    /**
     * @var array
     */
    protected $entry = [];

    /**
     * 当前的守卫名称
     * @var string $guard
     */
    protected $guard;

    /**
     * 当前商户的权限组d
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
     * 目前路由
     * @var object $route
     */
    protected $route;

    /**
     * @var array
     */
    protected $backend = [
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
     * 路由权限
     * @var boolean $routeAccessable
     */
    protected $routeAccessible = false;

    /**
     * 当前域名所属的平台
     * @var object $currentPlatformEloq
     */
    public $currentPlatformEloq;

    /**
     * MainAction constructor.
     * @param Request $request Request.
     * @throws Exception Exception.
     */
    public function __construct(Request $request)
    {
        new SystemPublicLogService($request, $request->get('logger'));
        $this->agent               = new Agent();
        $this->guard               = $request->get('guard');
        $this->auth                = auth($this->guard);
        $this->user                = $this->auth->user();
        $this->route               = $request->route();
        $this->currentPlatformEloq = $request->get('current_platform_eloq');
        if ($request->get('logger') !== 'backend') {
            return;
        }
        $this->_initial();
    }

    /**
     * Initial.
     * @return void
     * @throws Exception Exception.
     */
    private function _initial(): void
    {
        $this->_entry();
        if (!$this->auth->check()) {
            return;
        }
        if ($this->auth->user()->accessGroup()->exists()) {
            $this->currentAccessAdminGroup = $this->auth->user()->accessGroup;
            $this->adminAccessGroupDetail  = $this->currentAccessAdminGroup
                ->detail
                ->pluck('menu_id')
                ->toArray();
        }
        $this->_menuAccess();
        $this->_routeAccessCheck();
        if ($this->routeAccessible === false) {
            throw new Exception('100001');
        }
        if ($this->entry['portPrefix'] !== 'merchant-api') {
            return;
        }
        $this->currentPlatformEloq = $this->auth->user()->platform;
    }

    /**
     * 初始化所有菜单，目前商户该拥有的菜单与权限
     *
     * @return void
     */
    private function _menuAccess(): void
    {
        $menuModel           = new $this->entry['menu']();
        $this->fullMenuLists = $menuModel->forStar(); //所有的菜单
        //目前所有的菜单为前端展示用的
        $this->menuLists = $menuModel->getUserMenuDatas(
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
        $routeName  = $this->route->action['as'];
        $routeModel = new $this->entry['route']();
        $routeModel = $routeModel->where('route_name', $routeName)->first();
        if (empty($routeModel)) {
            return;
        }
        if (!$routeModel->menu) {
            return;
        }
        $this->_accessGroupCheck($routeModel->menu);
    }

    /**
     * Get entry.
     * @return void
     * @throws Exception Exception.
     */
    private function _entry(): void
    {
        $entry       = $this->guard;
        $this->entry = $this->$entry;
    }

    /**
     * 检查权限
     * @param mixed $menuModel 菜单Model.
     * @return void
     */
    private function _accessGroupCheck($menuModel): void
    {
        if (!in_array($menuModel->id, $this->adminAccessGroupDetail)) {
            return;
        }
        $this->routeAccessible = true;
    }
}
