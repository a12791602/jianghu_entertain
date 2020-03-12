<?php

namespace App\Lib\ErrorsHandler\Formatters;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;

/**
 * Class ExceptionFormatter
 * @package App\Lib\ErrorsHandler\Formatters
 */
class ExceptionFormatter extends BaseFormatter
{

    /**
     * @var integer
     */
    protected static $default_error_code = 500;

    /**
     * @param JsonResponse $response Response.
     * @param \Throwable   $e        Throwable Exception.
     * @return void
     */
    public function format(JsonResponse $response, \Throwable $e): void
    {
        $data       = $response->getData(true);
        $serverCode = $e->getCode();
        $code       = $e->getMessage();
        if (Lang::has('codes-map.' . $code)) {
            if (!empty($serverCode)) {
                $response->setStatusCode($serverCode);
            } else {
                $serverCode = 403;
                $response->setStatusCode($serverCode);//Forbidden
            }
            $message = __('codes-map.' . $code);
        } else {
            if (!empty($serverCode)) {
                $serverCode = ($this->_isInvalid($serverCode) ? self::$default_error_code : $serverCode);
            } else {
                $serverCode = self::$default_error_code;
            }
            $response->setStatusCode($serverCode);//Internal Server Error
            if ($this->debug) {
                $message           = $code;
                $data['exception'] = (string) $e;
                $data['line']      = $e->getLine();
                $data['file']      = $e->getFile();
            } else {
                $message = $this->config['server_error_production'];
            }
            $code = $serverCode;
        }
        $data = array_merge(
            $data,
            [
             'code'    => (string) $code,
             'message' => __($message),
            ],
        );
        $response->setData($data);
    }

    /**
     * @param integer $serverCode HttpCode.
     * @return boolean
     */
    private function _isInvalid(int $serverCode): bool
    {
        $result = $serverCode < 100 || $serverCode >= 600;
        return $result;
    }
}
