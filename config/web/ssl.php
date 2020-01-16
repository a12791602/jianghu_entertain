<?php

return [
    //生成ssl规则
        'rule' => [
                   'digest_alg'       => 'sha1024',
                   'private_key_bits' => 1024,                //字节数  512 1024 2048  4096 等
                   'private_key_type' => OPENSSL_KEYTYPE_RSA, //加密类型
                  ],
       ];
