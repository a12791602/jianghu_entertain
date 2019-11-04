<?php

use App\Lib\ErrorsHandler\Formatters;
use App\Lib\ErrorsHandler\ResponseFactory;
use Symfony\Component\HttpKernel\Exception as SymfonyException;

return [
    'add_cors_headers' => false,
    // Has to be in prioritized order, e.g. highest priority first.
    'formatters' => [
        SymfonyException\UnprocessableEntityHttpException::class => Formatters\UnprocessableEntityHttpExceptionFormatter::class,
        SymfonyException\HttpException::class => Formatters\HttpExceptionFormatter::class,
        Exception::class => Formatters\ExceptionFormatter::class,
    ],
    'response_factory' =>ResponseFactory::class,
    'reporters' => [
        /*'sentry' => [
            'class'  => \Optimus\Heimdal\Reporters\SentryReporter::class,
            'config' => [
                'dsn' => '',
                // For extra options see https://docs.sentry.io/clients/php/config/
                // php version and environment are automatically added.
                'sentry_options' => []
            ]
        ]*/
    ],
    'server_error_production' => 'An error occurred.'
];