<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:45 AM
 */

namespace App\Services\Logs\MerchantLogs;

use Monolog\Logger;

/**
 * Class MerchantLogMonolog
 * @package App\Services\Logs\MerchantLogs
 */
class MerchantLogMonolog
{
    /**
     * Create a custom Monolog instance.
     *
     * @return Logger
     */
    public function __invoke(): Logger
    {
        $logger = new Logger('merchant');
        $logger->pushHandler(new MerchantLogHandler());
        $logger->pushProcessor(new MerchantLogProcessor());
        return $logger;
    }
}
