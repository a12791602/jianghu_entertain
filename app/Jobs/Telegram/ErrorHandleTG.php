<?php

namespace App\Jobs\Telegram;

use App\Lib\TGMSG;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Jenssegers\Agent\Agent;

/**
 * Class ErrorHandleTG
 * @package App\Jobs\Telegram
 */
class ErrorHandleTG implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var array
     */
    protected $exception;

    /**
     * @var array
     */
    protected $request;

    /**
     * @var integer
     */
    protected $responseStatus;

    /**
     * @var array
     */
    protected $agent;

    /**
     * @var string
     */
    protected $currentRoute;

    /**
     * @var string
     */
    protected $routePrefix;

    /**
     * Create a new job instance.
     *
     * @param Exception    $e            Exception.
     * @param Request      $request      Requset.
     * @param JsonResponse $response     JsonResponse.
     * @param Agent        $agent        Agent.
     * @param Route|null   $currentRoute Current Route.
     */
    public function __construct(
        Exception $e,
        Request $request,
        JsonResponse $response,
        Agent $agent,
        ?Route $currentRoute
    ) {
        $this->_doInit($e, $request, $response, $agent, $currentRoute);
    }

    /**
     * initialize a new job instance.
     *
     * @param Exception    $e            Exception.
     * @param Request      $request      Requset.
     * @param JsonResponse $response     JsonResponse.
     * @param Agent        $agent        Agent.
     * @param Route|null   $currentRoute Current Route.
     * @return void
     * @throws \JsonException For JsonEncodeException.
     */
    private function _doInit(
        Exception $e,
        Request $request,
        JsonResponse $response,
        Agent $agent,
        ?Route $currentRoute
    ): void {
        $requestData          = [
                                 'ips'        => $request->ips(),
                                 'inputs'     => $request->all(),
                                 'crypt_data' => $request->get('crypt_data') ?? '', //加密的data
                                ];
        $requestOs            = $agent->platform();
        $osVersion            = $agent->version($requestOs);
        $browser              = $agent->browser();
        $bsVersion            = $agent->version($browser);
        $type                 = $this->_getDeviceType($agent);
        $this->agent          = [
                                 'origin'      => $agent->getHttpHeaders(),
                                 'user_agent'  => $agent->getUserAgent(),
                                 'lang'        => $agent->languages(), //array
                                 'device'      => $agent->device(),
                                 'os'          => $requestOs,
                                 'browser'     => $browser,
                                 'bs_version'  => $bsVersion,
                                 'os_version'  => $osVersion,
                                 'device_type' => $type,
                                 'robot'       => $agent->robot(),
                                ];
        $this->request        = $requestData;
        $errormsg             = json_encode(
            $response->getOriginalContent(),
            JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
            512,
        );
        $this->exception      = [
                                 'file'          => $e->getFile(),
                                 'line'          => $e->getLine(),
                                 'code'          => $e->getCode(),
                                 'message'       => $errormsg . ' ' . $e->getMessage(),
                                 'TraceAsString' => $e->getTraceAsString(),
                                ];
        $this->responseStatus = $response->getStatusCode();
        $this->currentRoute   = empty($currentRoute) ? null : $currentRoute->uri();
        $this->routePrefix    = empty($currentRoute) ? null : trim($currentRoute->getPrefix(), '/');
    }

    /**
     * 获取当前设备的信息
     * @param Agent $agent Agent.
     * @return string
     */
    private function _getDeviceType(Agent $agent): string
    {
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
        return $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \JsonException JsonException.
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException TelegramSDKException.
     */
    public function handle(): void
    {
        //###### sending errors to tg //Harris ############
        $appEnvironment = App::environment();
        $error          = [
                           'environment'   => $appEnvironment,
                           'route'         => $this->currentRoute,
                           'origin'        => $this->agent['origin'],
                           'ips'           => $this->request['ips'], //array
                           'user_agent'    => $this->agent['user_agent'],
                           'lang'          => $this->agent['user_agent'], //array
                           'device'        => $this->agent['device'],
                           'os'            => $this->agent['os'],
                           'browser'       => $this->agent['browser'],
                           'bs_version'    => $this->agent['bs_version'],
                           'os_version'    => $this->agent['os_version'],
                           'device_type'   => $this->agent['device_type'],
                           'robot'         => $this->agent['robot'],
                           'inputs'        => $this->request['inputs'],                   //array
                           'crypt_data'    => $this->request['crypt_data'], //加密的data
                           'file'          => $this->exception['file'],
                           'line'          => $this->exception['line'],
                           'code'          => $this->exception['code'],
                           'message'       => $this->exception['message'],
                           'TraceAsString' => $this->exception['TraceAsString'],
                          ];
        $telegram       = new TGMSG($this->responseStatus, $this->routePrefix);
        if ($telegram->chatId === null) {
            return;
        }
        $telegram->sendMessage((string) json_encode($error, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT, 512));
    }
}
