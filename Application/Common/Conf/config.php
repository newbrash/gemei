<?php
return array(
    //'配置项'=>'配置值'
    // 服务器地址
    'DB_HOST'        => '127.0.0.1',
    // 数据库名
    'DB_NAME'        => 'gemeiwj',
    // 用户名
    'DB_USER'        => 'root',
    // 密码
    'DB_PWD'        => 'root',
    'DB_TYPE' => 'mysql',       //数据库类型
    // 'DB_HOST' => 'localhost',   //host地址
    // 'DB_USER' => 'root',        //数据库用户名
    // 'DB_PWD' => 'root',         //数据库密码
    // 'DB_NAME' => 'navigation',  //数据名
    'DB_PREFIX' => 'nav_',      //表前缀
    'TMPL_PARSE_STRING'=>array(
        "__PUBLIC__"=>"/gemei_wj/Public",
        "PIC_URL"=>"/gemei_wj/Uploads/"
    )
);