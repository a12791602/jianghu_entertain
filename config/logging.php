<?php

use App\Services\Logs\BackendLogs\BackendLogMonolog;
use App\Services\Logs\FrontendLogs\FrontendLogMonolog;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

$config = [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

           'default'  => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

           'channels' => [
                          'stack'                   => [
                                                        'driver'            => 'stack',
                                                        'channels'          => ['daily'],
                                                        'ignore_exceptions' => false,
                                                       ],

                          'single'                  => [
                                                        'driver' => 'single',
                                                        'path'   => storage_path('logs/laravel.log'),
                                                        'level'  => 'debug',
                                                       ],

                          'daily'                   => [
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/laravel.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],
                          'telegram'                => [
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/telegram.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],
                          'slack'                   => [
                                                        'driver'   => 'slack',
                                                        'url'      => env('LOG_SLACK_WEBHOOK_URL'),
                                                        'username' => 'Laravel Log',
                                                        'emoji'    => ':boom:',
                                                        'level'    => 'critical',
                                                       ],

                          'papertrail'              => [
                                                        'driver'       => 'monolog',
                                                        'level'        => 'debug',
                                                        'handler'      => SyslogUdpHandler::class,
                                                        'handler_with' => [
                                                                           'host' => env('PAPERTRAIL_URL'),
                                                                           'port' => env('PAPERTRAIL_PORT'),
                                                                          ],
                                                       ],

                          'stderr'                  => [
                                                        'driver'    => 'monolog',
                                                        'handler'   => StreamHandler::class,
                                                        'formatter' => env('LOG_STDERR_FORMATTER'),
                                                        'with'      => ['stream' => 'php://stderr'],
                                                       ],

                          'syslog'                  => [
                                                        'driver' => 'syslog',
                                                        'level'  => 'debug',
                                                       ],

                          'errorlog'                => [
                                                        'driver' => 'errorlog',
                                                        'level'  => 'debug',
                                                       ],

                          'null'                    => [
                                                        'driver'  => 'monolog',
                                                        'handler' => NullHandler::class,
                                                       ],
                          'frontend'                => [
                                                        'driver' => 'custom',
                                                        'via'    => FrontendLogMonolog::class,
                                                       ],

                          'backend'                 => [
                                                        'driver' => 'custom',
                                                        'via'    => BackendLogMonolog::class,
                                                       ],
                          //记录请求第三方的数据
                          'finance-recharge-data'   => [
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/finance/recharge/data.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],

                          //记录签名前后数据
                          'finance-recharge-sign'   => [
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/finance/recharge/sign.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],

                          //记录发起充值时,支付系统的一些异常信息
                          'finance-recharge-system' => [
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/finance/recharge/system.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],

                          //记录接收到的回调参数
                          'finance-callback-data'   => [
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/finance/callback/data.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],

                          //记录回调时的签名前后信息
                          'finance-callback-sign'   => [
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/finance/callback/sign.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],

                          //记录回调时的一些系统异常信息
                          'finance-callback-system' => [
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/finance/callback/system.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],
                          // 发起提现时的异常信息
                          'withdrawal-system'       => [
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/withdrawal/system.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],
                          'ack-center'              => [//通知中心日志
                                                        'driver' => 'daily',
                                                        'path'   => storage_path('logs/ackcenter.log'),
                                                        'level'  => 'debug',
                                                        'days'   => 14,
                                                       ],
                         ],

          ];
return $config;
