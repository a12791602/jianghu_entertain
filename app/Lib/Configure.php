<?php

namespace App\Lib;

use App\Models\Systems\SystemConfiguration;
use Illuminate\Support\Facades\Cache;

/**
 * Class Configure
 *
 * @package App\Lib
 */
class Configure
{
    /**
     * system_configurations
     *
     * @param  string      $platformSign 平台标识.
     * @param  string      $configKey    ConfigureKey.
     * @param  string|null $default      Value.
     * @return mixed
     */
    public function getData(string $platformSign, string $configKey, ?string $default = null)
    {
        $tags = self::getTags($platformSign);
        $data = Cache::tags($tags)->get(
            $configKey,
            static function () use (
                $configKey,
                $default,
                $tags,
                $platformSign
            ) {
                $result = SystemConfiguration::where(
                    [
                     [
                      'platform_sign',
                      $platformSign,
                     ],
                     [
                      'sign',
                      $configKey,
                     ],
                    ],
                )->where('status', '=', 1)->first();
                if ($result === null) {
                    return $default;
                }
                Cache::tags($tags)->forever($configKey, $result->value);
                return $result->value;
            },
        );
        return $data;
    }

    /**
     * Setting Data into the Config
     *
     * @param string $platformSign 平台标识.
     * @param string $configKey    Config Key.
     * @param string $value        Value.
     * @return void
     */
    public static function setData(string $platformSign, string $configKey, string $value): void
    {
        $tags = self::getTags($platformSign);
        SystemConfiguration::where(
            [
             [
              'platform_sign',
              $platformSign,
             ],
             [
              'sign',
              $configKey,
             ],
            ],
        )->update(['value' => $value]);
        Cache::tags($tags)->forget($configKey);
    }

    /**
     * clean the cache
     *
     * @param string $platformSign 平台标识.
     * @return void
     */
    public function flush(string $platformSign): void
    {
        $tags = self::getTags($platformSign);
        Cache::tags($tags)->flush();
    }

    /**
     * get Tag name
     *
     * @param  string $platformSign 平台标识.
     * @return string
     */
    public static function getTags(string $platformSign): string
    {
        $tags = $platformSign . 'configure';
        return $tags;
    }
}
