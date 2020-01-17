<?php

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

        'supportsCredentials'    => false,
        'allowedOrigins'         => [
                                     'http://h5.jianghu.local',
                                     'http://madmin.jianghu.local',
                                     'http://cadmin.jianghu.local',
                                     'http://10.10.50.127:8080',// Marsh
                                     'http://10.10.50.194:8081',// Aaron
                                     'http://10.10.40.196:7456',// Ray
                                    ],
        'allowedOriginsPatterns' => [],
        'allowedHeaders'         => ['*'],
        'allowedMethods'         => [
                                     'GET',
                                     'POST',
                                     'PUT',
                                     'PATCH',
                                    ],
        'exposedHeaders'         => [],
        'maxAge'                 => 0,
       ];
