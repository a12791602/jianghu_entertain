<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Class Kernel
 * @package App\Http
 */
class Kernel extends HttpKernel
{

    /**
     * web use constant
     */
    private const MW_GROUP_WEB = [
                                  \App\Http\Middleware\EncryptCookies::class,
                                  \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                                  \Illuminate\Session\Middleware\StartSession::class,
                                    // \Illuminate\Session\Middleware\AuthenticateSession::class,
                                  \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                                  \App\Http\Middleware\VerifyCsrfToken::class,
                                  \Illuminate\Routing\Middleware\SubstituteBindings::class,
                                 ];

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
                             \App\Http\Middleware\TrustProxies::class,
                             \App\Http\Middleware\CheckForMaintenanceMode::class,
                             \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
                             \App\Http\Middleware\TrimStrings::class,
                             \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
                             \Fruitcake\Cors\HandleCors::class,
                            ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
                                   'web'                   => self::MW_GROUP_WEB,

                                   'frontend-api'          => [
                                                               'throttle:300,1',
                                                               'bindings',
                                                               'crypt',
                                                               'route-auth',
                                                              ],
                                   'frontend-h5-api'       => [
                                                               'throttle:300,1',
                                                               'bindings',
                                                               'crypt',
                                                               'route-auth',
                                                              ],
                                   'backend-api'           => [
                                                               'throttle:500,1',
                                                               'bindings',
                                                               'route-auth',
                                                              ],
                                   'merchant-api'          => [
                                                               'throttle:500,1',
                                                               'bindings',
                                                               'route-auth',
                                                              ],
                                   /**
                                    * verification code
                                    */
                                   'frontend-verification' => [
                                                               'crypt',
                                                               'route-auth',
                                                              ],//'throttle:1,1',
                                   /**
                                    * login / registration
                                    */
                                   'frontend-registration' => [
                                                               'throttle:5,1',
                                                               'crypt',
                                                               'route-auth',
                                                              ],
                                  ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
                                  'auth.basic'       => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
                                  'bindings'         => \Illuminate\Routing\Middleware\SubstituteBindings::class,
                                  'cache.headers'    => \Illuminate\Http\Middleware\SetCacheHeaders::class,
                                  'can'              => \Illuminate\Auth\Middleware\Authorize::class,
                                  'guest'            => \App\Http\Middleware\RedirectIfAuthenticated::class,
                                  'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
                                  'signed'           => \Illuminate\Routing\Middleware\ValidateSignature::class,
                                  'throttle'         => \Illuminate\Routing\Middleware\ThrottleRequests::class,
                                  'verified'         => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
                                  'crypt'            => \App\Http\Middleware\Crypt::class,//全局加密
                                  'route-auth'       => \App\Http\Middleware\RouteAuth::class,//路由权限
                                 ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
                                     \Illuminate\Session\Middleware\StartSession::class,
                                     \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                                     \App\Http\Middleware\Authenticate::class,
                                     \Illuminate\Routing\Middleware\ThrottleRequests::class,
                                     \Illuminate\Session\Middleware\AuthenticateSession::class,
                                     \Illuminate\Routing\Middleware\SubstituteBindings::class,
                                     \Illuminate\Auth\Middleware\Authorize::class,
                                    ];
}
