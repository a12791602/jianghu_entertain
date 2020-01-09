<?php

namespace App\Lib\ErrorsHandler\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;

class ExceptionFormatter extends BaseFormatter
{
    protected static $default_error_code = 500;

    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $data = $response->getData(true);
        $serverCode = $e->getCode();
        $code = $e->getMessage();
        if (Lang::has('codes-map.' . $code)) {
            if (!empty($serverCode)) {
                $response->setStatusCode($serverCode);
            } else {
                $serverCode = 403;
                $response->setStatusCode($serverCode);//Forbidden
            }
            $message = __('codes-map.' . $code);
        } else {
            $serverCode = !empty($serverCode) ? ($this->_isInvalid($serverCode) ? self::$default_error_code : $serverCode) : self::$default_error_code;
            $response->setStatusCode($serverCode);//Internal Server Error
            if ($this->debug) {
                $message = $code;
                $data['exception'] = (string)$e;
                $data['line'] = $e->getLine();
                $data['file'] = $e->getFile();
            } else {
                $message = $this->config['server_error_production'];
            }
            $code = $serverCode;
        }
        $data = array_merge($data, [
            'code' => (string) $code,
            'message' => $message,
        ]);
        $response->setData($data);
    }

    /**
     * @param int $serverCode HttpCode.
     * @return bool
     */
    private function _isInvalid(int $serverCode): bool
    {
        $result= $serverCode < 100 || $serverCode >= 600;
        return $result;
    }
}
