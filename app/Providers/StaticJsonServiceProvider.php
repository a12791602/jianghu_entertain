<?php
/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 8/14/2019
 * Time: 6:14 PM
 */

namespace App\Providers;

use App\Lib\StaticJson\StaticJsonHandler;
use Illuminate\Support\ServiceProvider;

/**
 * Class StaticJsonServiceProvider
 * @package App\Providers
 */
class StaticJsonServiceProvider extends ServiceProvider
{
    /**
     * register facades
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            'StaticJson',
            static function () {
                return new StaticJsonHandler();
            },
        );
    }
}
