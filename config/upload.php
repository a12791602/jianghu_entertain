<?php

return [
    'input_name' => 'file', //表单键的 name
    'max_size' => '1000000', //最大文件大小 单位 kb
    'mimes' => 'image/jpeg,image/png,image/bmp,image/gif', //可以接受的文件类型
    'disk' => 'public', //储存路径 对应 filesystems 中的磁盘配置
];
