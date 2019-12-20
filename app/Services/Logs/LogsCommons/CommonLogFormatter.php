<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 9:59 AM
 */

namespace App\Services\Logs\LogsCommons;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Monolog\Formatter\NormalizerFormatter;

/**
 * Class CommonLogFormatter
 * @package App\Services\Logs\LogsCommons
 */
class CommonLogFormatter extends NormalizerFormatter
{
    /**
     * type
     */
    public const LOGMARK = 'log';

    public const STORE = 'store';

    public const CHANGE = 'change';

    public const DELETE = 'delete';

    /**
     * result
     */
    public const SUCCESS = 'success';

    public const NEUTRAL = 'neutral';

    public const FAILURE = 'failure';


    /**
     * @param array $record Records.
     * @return mixed
     */
    public function format(array $record)
    {
        $record = parent::format($record);
        $return = $this->getDocument($record);
        return $return;
    }

    /**
     * Convert a log message into an MariaDB Log entity
     * @param array $record Records.
     * @return mixed[]
     */
    protected function getDocument(array $record): array
    {
        $fills                = $record['extra'];
        $fills['level']       = Str::lower($record['level_name']);
        $fills['description'] = $record['message'];
        $fills['token']       = Str::random(30);
        $context              = $record['context'];
        if (!empty($context)) {
            $fills['type']   = Arr::has($context, 'type') ? $context['type'] : self::LOGMARK;
            $fills['result'] = Arr::has($context, 'result') ? $context['result'] : self::NEUTRAL;
            $fills           = array_merge($record['context'], $fills);
        }
        return $fills;
    }
}
