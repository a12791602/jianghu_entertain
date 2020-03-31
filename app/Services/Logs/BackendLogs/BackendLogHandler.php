<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:48 AM
 */

namespace App\Services\Logs\BackendLogs;

use App\Services\Logs\LogsCommons\CommonLogFormatter;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;

/**
 * Class BackendLogHandler
 * @package App\Services\Logs\BackendLogs
 */
class BackendLogHandler extends AbstractProcessingHandler
{
    /**
     * @param array $record Records.
     * @return void
     */
    protected function write(array $record): void
    {
        // Queue implementation
        event(new BackendLogMonologEvent($record));
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
