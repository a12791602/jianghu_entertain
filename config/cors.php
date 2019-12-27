<?php

use App\Models\Systems\SystemDomain;

$allowed = SystemDomain::where('status', SystemDomain::STATUS_OPEN)->pluck('domain')->all();
return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => false,
    'allowedOrigins' => $allowed,
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['*'],
    'allowedMethods' => ['GET', 'POST', 'PUT', 'PATCH'],
    'exposedHeaders' => [],
    'maxAge' => 0,
];
