<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:48 AM
 */

namespace App\Services\Logs\MerchantLogs;

use App\Services\Logs\LogsCommons\CommonLogFormatter;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;

/**
 * Class MerchantLogHandler
 * @package App\Services\Logs\MerchantLogs
 */
class MerchantLogHandler extends AbstractProcessingHandler
{
    /**
     * @param array $record Records.
     * @return void
     */
    protected function write(array $record): void
    {
        // Queue implementation
        event(new MerchantLogMonologEvent($record));
    }


    /**
     * inheritDoc
     *
     * @return FormatterInterface
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new CommonLogFormatter();
    }
}
