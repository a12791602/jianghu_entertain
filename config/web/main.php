<?php

$result = [
          //缓存
           'cache'                   => [
                                         'account_change_type' => [
                                                                   'key'         => 'account_change_type',
                                                                   'expire_time' => 0,
                                                                   'name'        => '帐变类型缓存',
                                                                   'tags'        => 'account',
                                                                  ],
                                        ],
           // Front-end user ID Redis key.
           'frontend_user_unique_id' => 'register_user_id',
          ];
return $result;
