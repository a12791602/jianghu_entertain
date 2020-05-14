<?php
return [
        'data' => [
                   'system_banks' => [
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
                  ],
       ];
