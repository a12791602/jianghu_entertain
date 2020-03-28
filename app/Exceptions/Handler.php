<?php

namespace App\Exceptions;

use App\Jobs\Telegram\ErrorHandleTG;
use App\Lib\Crypt\DataCrypt;
use App\Lib\ErrorsHandler\Formatters\BaseFormatter;
use App\Lib\ErrorsHandler\Reporters\ReporterInterface;
use Asm89\Stack\CorsService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Exception\InvalidArgumentException;
use Throwable;

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
     * A list of the internal exception types that should not be reported.
     *
     * @var array
     */
    protected $internalDontReport = [];

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
     * @param Throwable $e Exception.
     * @return void
     * @throws Throwable|InvalidArgumentException Exception.
     */
    public function report(Throwable $e): void
    {
        parent::report($e);
        $this->reportResponses = [];
        if ($this->shouldntReport($e)) {
            return;
        }
        $this->_checkReporter($e);
        $request      = request();
        $response     = $this->_generateExceptionResponse($request, $e);
        $agent        = new Agent();
        $currentRoute = Route::getCurrentRoute();
        dispatch(new ErrorHandleTG($e, $request, $response, $agent, $currentRoute));
    }

    /**
     * Handle Reporter
     * @param Throwable $e Exception.
     * @return void
     * @throws Throwable|InvalidArgumentException Exception.
     */
    private function _checkReporter(Throwable $e): void
    {
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

    // phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing

    /**
     * Render
     *
     * @param Request   $request Request.
     * @param Throwable $e       Exception.
     * @return Response
     * @throws Throwable|InvalidArgumentException Exception.
     */
    public function render($request, Throwable $e): Response
    {
        // phpcs:enable Squiz.Commenting.FunctionComment.TypeHintMissing
        $response = $this->_generateExceptionResponse($request, $e);
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
     * @param Throwable $e       Exception.
     * @return mixed
     * @throws Throwable|InvalidArgumentException Exception.
     */
    private function _generateExceptionResponse(Request $request, Throwable $e)
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
        $originData  = $response->getData();
        $handledData = DataCrypt::handle($originData);
        $response->setData($handledData);
        $response->unCryptedData = $originData;
        return $response;
    }

    // phpcs:disable Squiz.Commenting.FunctionComment.TypeHintMissing

    /**
     * @param Request                 $request   Request.
     * @param AuthenticationException $exception Exception.
     * @return Response
     * @throws Throwable|Exception Exception.
     */
    protected function unauthenticated($request, AuthenticationException $exception): Response
    {
        // phpcs:enable Squiz.Commenting.FunctionComment.TypeHintMissing
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
}
