<?php

/*
|--------------------------------------------------------------------------
| Laravel CORS
|--------------------------------------------------------------------------
|
| allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
| to accept any value.
|
*/
$result = [
           'supportsCredentials'    => false,
           'allowedOrigins'         => [
                                        'http://h5.jianghu.local',
                                        'http://app.jianghu.com',
                                        'http://madmin.jianghu.local',
                                        'http://cadmin.jianghu.local',
                                        'http://10.10.50.127:8080',// Marsh
                                        'http://m.jianghu.com',// Marsh
                                        'http://10.10.50.198:8081',// Aaron
                                        'http://10.10.40.196:7456',// Ray
                                        'http://app.397017.com',
                                        'http://10.10.50.209:8081',// Charon
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
return $result;
