<?php

namespace App\Exceptions;

use App\Lib\ErrorsHandler\Formatters\BaseFormatter;
use App\Lib\ErrorsHandler\Reporters\ReporterInterface;
use App\Lib\TGMSG;
use Asm89\Stack\CorsService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Exception\InvalidArgumentException;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{

    /**
     * get error config
     *
     * @var array
     */
    protected $config;

    /**
     * get error config for container
     *
     * @var object
     */
    protected $container;

    /**
     * get error config debug
     *
     * @var string
     */
    protected $debug;

    /**
     * error report response
     *
     * @var array
     */
    protected $reportResponses = [];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
                            'password',
                            'password_confirmation',
                           ];

    /**
     * ExceptionHandler constructor.
     *
     * @param Container $container GettingContainer.
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->config = $container['config']->get('overall-exception');
        $this->debug  = $container['config']->get('app.debug');
    }

    /**
     * @param Exception $e Exception.
     * @return void
     * @throws Exception|InvalidArgumentException Exception.
     */
    public function report(Exception $e): void
    {
        parent::report($e);
        $this->reportResponses = [];
        if ($this->shouldntReport($e)) {
            return;
        }
        $reporters = $this->config['reporters'];
        foreach ($reporters as $rpKey => $reporter) {
            $class           = $reporter['class'] ?? null;
            $classNull       = $class === null;
            $classNotExist   = !class_exists($class);
            $classHasNotImpl = !in_array(ReporterInterface::class, class_implements($class), true);
            if ($classNull || $classNotExist || $classHasNotImpl) {
                throw new InvalidArgumentException(
                    sprintf(
                        '%s: %s is not a valid reporter class.',
                        $rpKey,
                        $class,
                    ),
                );
            }
            $config = isset($reporter['config']) && is_array($reporter['config']) ? $reporter['config'] : [];
            // $this->container->make($class)($config) fails php <= 5.4
            $reporterFactory               = $this->container->make($class);
            $reporterInstance              = $reporterFactory($config);
            $this->reportResponses[$rpKey] = $reporterInstance->report($e);
        }
    }

    /**
     * Render
     *
     * @param Request   $request Request.
     * @param Exception $e       Exception.
     * @return Response
     * @throws Exception|InvalidArgumentException Exception.
     */
    public function render($request, Exception $e): Response
    {
        $response = $this->_generateExceptionResponse($request, $e);
        $this->_sendToTg($e, $request, $response);
        if ($this->config['add_cors_headers']) {
            if (!class_exists(CorsService::class)) {
                throw new InvalidArgumentException(
                    '400001',
                );
            }
            /**
             * @var CorsService $cors
             */
            $cors = $this->container->make(CorsService::class);
            $cors->addActualRequestHeaders($response, $request);
        }
        return $response;
    }

    /**
     * Generate exception response
     *
     * @param Request   $request Request.
     * @param Exception $e       Exception.
     * @return mixed
     * @throws Exception|InvalidArgumentException Exception.
     */
    private function _generateExceptionResponse(Request $request, Exception $e)
    {
        $formatters = $this->config['formatters'];
        // :: notation will otherwise not work for PHP <= 5.6
        $responseFactoryClass = $this->config['response_factory'];
        // Allow users to have a base formatter for every response.
        $response = $responseFactoryClass::make($e);
        foreach ($formatters as $exceptionType => $formatter) {
            if (!($e instanceof $exceptionType)) {
                continue;
            }
            $classNotExist     = !class_exists($formatter);
            $classhasNoReflect = !(new ReflectionClass($formatter))
                ->isSubclassOf(new ReflectionClass(BaseFormatter::class));
            if ($classNotExist || $classhasNoReflect) {
                $data = array_merge($formatter, $request->all());
                throw new InvalidArgumentException(
                    sprintf(
                        '%s is not a valid formatter class.',
                        json_encode($data, JSON_THROW_ON_ERROR, 512),
                    ),
                );
            }
            $formatterInstance = new $formatter($this->config, $this->debug);
            $formatterInstance->format($response, $e, $this->reportResponses);

            break;
        }
        return $response;
    }

    /**
     * @param Request                 $request   Request.
     * @param AuthenticationException $exception Exception.
     * @return Response
     * @throws Exception Exception.
     */
    protected function unauthenticated($request, AuthenticationException $exception): Response
    {
        if ($request->expectsJson()) {
            $message = $exception->getMessage();
            if ($message === 'Unauthenticated.') {
                throw new Exception('100034');
            } else {
                $result = ['message' => $message];
            }
            $return = response()->json($result);
            return $return;
        }
        $redirect = redirect()->guest($exception->redirectTo() ?? route('login'));
        return $redirect;
    }

    /**
     * @param Exception    $e        Exception.
     * @param Request      $request  Requset.
     * @param JsonResponse $response JsonResponse.
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException TelegramSDKException.
     */
    private function _sendToTg(Exception $e, Request $request, JsonResponse $response): void
    {
        //###### sending errors to tg //Harris ############
        $appEnvironment = App::environment();
        $agent          = new Agent();
        $requestOs      = $agent->platform();
        $osVersion      = $agent->version($requestOs);
        $browser        = $agent->browser();
        $bsVersion      = $agent->version($browser);
        $robot          = $agent->robot();
        if ($agent->isRobot()) {
            $type = 'robot';
        } elseif ($agent->isDesktop()) {
            $type = 'desktop';
        } elseif ($agent->isTablet()) {
            $type = 'tablet';
        } elseif ($agent->isMobile()) {
            $type = 'mobile';
        } elseif ($agent->isPhone()) {
            $type = 'phone';
        } else {
            $type = 'other';
        }
        $currentRoute = Route::getCurrentRoute();
        $route        = empty($currentRoute) ? null : $currentRoute->uri();
        $error        = [
                         'environment'   => $appEnvironment,
                         'route'         => $route,
                         'origin'        => $agent->getHttpHeaders(),
                         'ips'           => $request->ips(), //array
                         'user_agent'    => $agent->getUserAgent(),
                         'lang'          => $agent->languages(), //array
                         'device'        => $agent->device(),
                         'os'            => $requestOs,
                         'browser'       => $browser,
                         'bs_version'    => $bsVersion,
                         'os_version'    => $osVersion,
                         'device_type'   => $type,
                         'robot'         => $robot,
                         'inputs'        => $request->all(),                   //array
                         'data'          => $request->get('crypt_data') ?? '', //加密的data
                         'file'          => $e->getFile(),
                         'line'          => $e->getLine(),
                         'code'          => $e->getCode(),
                         'message'       => $e->getMessage(),
                         'previous'      => $e->getPrevious(),
                         'TraceAsString' => $e->getTraceAsString(),
                        ];
        $telegram     = new TGMSG($response);
        $telegram->sendMessage((string) json_encode($error, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512));
    }
}
