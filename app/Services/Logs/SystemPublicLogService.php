<?php

namespace App\Services\Logs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class SystemPublicLogService
 * @package App\Services\Logs
 */
class SystemPublicLogService
{

    /**
     * Get all input requests.
     * @var array Input.
     */
    private $input;

    /**
     * Generate log uuid.
     * @var string Log_uuid
     */
    private $log_uuid;

    /**
     * Get the route handling the request.
     * @var mixed Route.
     */
    private $route;

    /**
     * Get the route handling the request.
     * @var string Route.
     */
    private $logger;

    /**
     * Constructor.
     * @param Request $request Request.
     * @param string  $logger  Logger name.
     */
    public function __construct(Request $request, string $logger)
    {
        $nodeHex        = getUUidNodeHex();
        $this->log_uuid = $nodeHex;
        $this->input    = $request->all(); //获取所有相关的传参数据
        $this->route    = $request->route();
        $this->logger   = $logger;
        $this->_operationLog();
    }

    /**
     * Store user operation logs.
     * @return void
     */
    private function _operationLog(): void
    {
        $data    = [
                    'input'    => $this->input,
                    'route'    => $this->route,
                    'log_uuid' => $this->log_uuid,
                   ];
        $logData = json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE, 512);
        Log::channel($this->logger)->info($logData);
    }
}
