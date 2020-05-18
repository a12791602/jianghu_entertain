<?php
return [
        'data' => [
                   'system_banks'              => [
                                                   'use_type'    => 1,//common
                                                   'type'        => \App\Models\Systems\StaticResource::TYPE_WHOLE_TABLE,//1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
                                                   'path'        => 'common/financial/banks/system_banks',//需要保存json的路径
                                                   'title'       => 'system_banks_available',
                                                   'description' => '系统支持银行',
                                                   'model'       => \App\Models\Finance\SystemBank::Class,//model Name
                                                   'fields'      => [
                                                                     'id',
                                                                     'name',
                                                                     'code',
                                                                     'status',
                                                                    ],
                                                   'redis_index' => 'static_jsons_common',//config/web/main.php 里面的 redis_index 要存入的 redis 组
                                                  ],
                   'system_command_list'       => [
                                                   'use_type'    => 1,//common
                                                   'type'        => \App\Models\Systems\StaticResource::TYPE_COMMAND,//1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
                                                   'path'        => 'common/command',//需要保存json的路径
                                                   'title'       => 'system_command_list',
                                                   'description' => '系统定时任务命令集',
                                                   'redis_index' => 'static_jsons_common',//config/web/main.php 里面的 redis_index 要存入的 redis 组
                                                  ],
                   'user_account_type'         => [
                                                   'use_type'    => 1,//common
                                                   'type'        => \App\Models\Systems\StaticResource::TYPE_WHOLE_TABLE,//1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
                                                   'path'        => 'common/account',//需要保存json的路径
                                                   'title'       => 'frontend_users_accounts_types',
                                                   'description' => '用户账变类型',
                                                   'model'       => \App\Models\User\FrontendUsersAccountsTypesGroup::Class,//model Name
                                                   'relations'   => [
                                                                     'accountType' => [
                                                                                       'id',
                                                                                       'group_type_id',
                                                                                       'name',
                                                                                       'sign',
                                                                                      ],//表 relation 的 关系 与 字段
                                                                    ],
                                                   'fields'      => [
                                                                     'id',
                                                                     'group_name',
                                                                    ],//主表的字段
                                                   'redis_index' => 'static_jsons_common',//config/web/main.php 里面的 redis_index 要存入的 redis 组
                                                  ],
                   'game_type_vendors_lists'   => [
                                                   'use_type'    => 1,//common
                                                   'type'        => \App\Models\Systems\StaticResource::TYPE_WHOLE_TABLE,//1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
                                                   'path'        => 'common/game',//需要保存json的路径
                                                   'title'       => 'game_type_vendors',
                                                   'description' => '游戏主类型对应厂商列表',
                                                   'model'       => \App\Models\Game\GameType::class,//model Name
                                                   'relations'   => [
                                                                     'vendors' => [
                                                                                   'type_id',
                                                                                   'id',
                                                                                   'name',
                                                                                   'sign',
                                                                                  ],//表 relation 的 关系 与 字段
                                                                    ],
                                                   'fields'      => [
                                                                     'id',
                                                                     'name',
                                                                     'sign',
                                                                    ],//主表的字段
                                                   'redis_index' => 'static_jsons_common',//config/web/main.php 里面的 redis_index 要存入的 redis 组
                                                  ],
                   'game_lists_by_vendors'     => [
                                                   'use_type'    => 1,//common
                                                   'type'        => \App\Models\Systems\StaticResource::TYPE_WHOLE_TABLE,//1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
                                                   'path'        => 'common/game',//需要保存json的路径
                                                   'title'       => 'game_vendors__games',
                                                   'description' => '游戏系列对应厂商列表',
                                                   'model'       => \App\Models\Game\GameVendor::class,//model Name
                                                   'relations'   => [
                                                                     'gamesUnderVendor' => [
                                                                                            'vendor_id',
                                                                                            'id',
                                                                                            'name',
                                                                                            'sign',
                                                                                           ],//表 relation 的 关系 与 字段
                                                                    ],
                                                   'fields'      => [
                                                                     'id',
                                                                     'name',
                                                                     'sign',
                                                                    ],//主表的字段
                                                   'redis_index' => 'static_jsons_common',//config/web/main.php 里面的 redis_index 要存入的 redis 组
                                                  ],
                   'game_subtype_by_main_type' => [
                                                   'use_type'    => 1,//common
                                                   'type'        => \App\Models\Systems\StaticResource::TYPE_WHOLE_TABLE,//1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
                                                   'path'        => 'common/game',//需要保存json的路径
                                                   'title'       => 'game_main_type__sub_type',
                                                   'description' => '游戏主类对应次类',
                                                   'model'       => \App\Models\Game\GameType::class,//model Name
                                                   'relations'   => [
                                                                     'children' => [
                                                                                    'parent_id',
                                                                                    'id',
                                                                                    'name',
                                                                                    'sign',
                                                                                   ],//表 relation 的 关系 与 字段
                                                                    ],
                                                   'fields'      => [
                                                                     'id',
                                                                     'name',
                                                                     'sign',
                                                                    ],//主表的字段
                                                   'redis_index' => 'static_jsons_common',//config/web/main.php 里面的 redis_index 要存入的 redis 组
                                                  ],
                  ],
       ];
