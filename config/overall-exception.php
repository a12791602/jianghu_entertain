<?php

use App\Lib\ErrorsHandler\Formatters;
use App\Lib\ErrorsHandler\ResponseFactory;
use Symfony\Component\HttpKernel\Exception as SymfonyException;

// phpcs:disable Generic.Files.LineLength.MaxExceeded,Generic.Files.LineLength.TooLong

$config = [
           'add_cors_headers'        => false,
    // Has to be in prioritized order, e.g. highest priority first.
           'formatters'              => [
                                         SymfonyException\UnprocessableEntityHttpException::class => Formatters\UnprocessableEntityHttpExceptionFormatter::class,
                                         SymfonyException\HttpException::class                    => Formatters\HttpExceptionFormatter::class,
                                         \Illuminate\Validation\ValidationException::class        => Formatters\ValidationExceptionFormatter::class,
                                         PDOException::class                                      => Formatters\PDOExceptionFormatter::class,
                                         \Illuminate\Auth\AuthenticationException::class          => Formatters\AuthExceptionFormatter::class,
                                         Error::class                                             => Formatters\ExceptionFormatter::class,
                                         ArgumentCountError::class                                => Formatters\ExceptionFormatter::class,
                                        ],
           'response_factory'        => ResponseFactory::class,
           'reporters'               => [],
           'server_error_production' => 'An error occurred.',
          ];
// phpcs:enable Generic.Files.LineLength.MaxExceeded,Generic.Files.LineLength.TooLong
return $config;
/*'reporters' => [
    'sentry' => [
        'class'  => \Optimus\Heimdal\Reporters\SentryReporter::class,
        'config' => [
            'dsn' => '',
            // For extra options see https://docs.sentry.io/clients/php/config/
            // php version and environment are automatically added.
            'sentry_options' => []
        ]
    ]
]*/
