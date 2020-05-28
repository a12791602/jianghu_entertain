<?php


namespace App\Lib\ErrorsHandler;

use Illuminate\Support\Facades\Lang;

/**
 * Class ExceptionHelper
 * @package App\Lib\ErrorsHandler
 */
class ExceptionHelper
{

    /**
     * @param \Throwable $e Exception.
     * @return boolean
     */
    public static function checkStatusCodeTransl(\Throwable $e): bool
    {
        $code = $e->getMessage();
        return Lang::has('codes-map.' . $code);
    }
}
