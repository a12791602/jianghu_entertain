<?php

namespace App\Lib\ErrorsHandler\Formatters;

use Illuminate\Http\JsonResponse;

/**
 * Class BaseFormatter
 * @package App\Lib\ErrorsHandler\Formatters
 */
abstract class BaseFormatter
{

    /**
     * @var array
     */
    protected $config;

    /**
     * @var boolean
     */
    protected $debug;

    /**
     * BaseFormatter constructor.
     * @param array   $config Config From overall-exception.php.
     * @param boolean $debug  Debug if open.
     */
    public function __construct(array $config, bool $debug)
    {
        $this->debug  = $debug;
        $this->config = $config;
    }

    /**
     * @param JsonResponse $response Response.
     * @param \Throwable   $e        ThrowAble Exception.
     * @return void
     */
    abstract protected function format(
        JsonResponse $response,
        \Throwable $e
    ): void;
}
