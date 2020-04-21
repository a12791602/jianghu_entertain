<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Options
    |--------------------------------------------------------------------------
    |
    | The allowed_methods and allowed_headers options are case-insensitive.
    |
    | You don't need to provide both allowed_origins and allowed_origins_patterns.
    | If one of the strings passed matches, it is considered a valid origin.
    |
    | If array('*') is provided to allowed_methods, allowed_origins or allowed_headers
    | all methods / origins / headers are allowed.
    |
    */

    /*
     * You can enable CORS for 1 or multiple paths.
     * Example: ['api/*']
     */
        'paths'                    => [
                                       'app-api/*',//for application ends apk and app etc.
                                       'merchant-api/*',//for web-ends
                                       'headquarters-api/*',//for web-ends
                                       'h5-api/*',//for web-end
                                      ],

           /*
           * Matches the request method. `[*]` allows all methods.
           */
        'allowed_methods'          => [
                                       'GET',
                                       'POST',
                                       'PUT',
                                       'PATCH',
                                      ],

           /*
           * Matches the request origin. `[*]` allows all origins.
           */
        'allowed_origins'          => [
                                       'http://h5.jianghu.local',
                                       'http://app.jianghu.com',
                                       'http://madmin.jianghu.local',
                                       'http://cadmin.397017.com',
                                       'http://madmin.397017.com',
                                       'http://cadmin.jianghu.local',
                                       'http://10.10.50.127:8080',// Marsh
                                       'http://m.jianghu.com',// Marsh
                                       'http://10.10.50.198:8081',// Aaron
                                       'http://10.10.40.196:7456',// Ray
                                       'http://app.397017.com',
                                       'http://10.10.50.209:8081',// Charon
                                       'chrome-extension://jenkimcegeigaklkimboldgkpfliakpa',// Ethan
                                       'chrome-extension://pbmmpghdpldmkehedckllojmlfaihpkk',// Charon
                                       'chrome-extension://nhbkehcdobchkimobfcfdpknkdjaogec',// Aaron
                                       'http://192.168.1.30:8081',// Aaron
                                       'http://192.168.1.29:8081',// Charon
                                      ],

           /*
           * Matches the request origin with, similar to `Request::is()`
           */
        'allowed_origins_patterns' => [],

           /*
           * Sets the Access-Control-Allow-Headers response header. `[*]` allows all headers.
           */
        'allowed_headers'          => ['*'],

           /*
           * Sets the Access-Control-Expose-Headers response header.
           */
        'exposed_headers'          => false,

           /*
           * Sets the Access-Control-Max-Age response header.
           */
        'max_age'                  => false,

           /*
           * Sets the Access-Control-Allow-Credentials header.
           */
        'supports_credentials'     => false,
       ];
