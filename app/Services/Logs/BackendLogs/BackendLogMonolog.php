<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:45 AM
 */

namespace App\Services\Logs\BackendLogs;

use Monolog\Logger;

/**
 * Class BackendLogMonolog
 * @package App\Services\Logs\BackendLogs
 */
class BackendLogMonolog
{
    /**
     * Create a custom Monolog instance.
     *
     * @return Logger
     */
    public function __invoke(): Logger
    {
        $logger = new Logger('apibyqueue');
        $logger->pushHandler(new BackendLogHandler());
        $logger->pushProcessor(new BackendLogProcessor());
        return $logger;
    }
}
