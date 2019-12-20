<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:45 AM
 */

namespace App\Services\Logs\FrontendLogs;

use Monolog\Logger;

/**
 * Class FrontendLogMonolog
 * @package App\Services\Logs\FrontendLogs
 */
class FrontendLogMonolog
{
    /**
     * Create a custom Monolog instance.
     *
     * @return Logger
     */
    public function __invoke(): Logger
    {
        $logger = new Logger('frontend-by-queue');
        $logger->pushHandler(new FrontendLogHandler());
        $logger->pushProcessor(new FrontendLogProcessor());
        return $logger;
    }
}
