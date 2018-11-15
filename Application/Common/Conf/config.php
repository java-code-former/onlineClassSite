<?php
return array(
    'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'x_', // 数据库表前缀
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'wuhan', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码   
    'MODULE_ALLOW_LIST'    =>    array('Home','Admin','Enem','Enad'),
    'DEFAULT_MODULE'       =>    'Home',
    'DEFAULT_CONTROLLER'    =>  'Index',
    'DEFAULT_ACTION'        =>  'index',
    'URL_CASE_INSENSITIVE' => true, // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL' => 2, // URL访问模式,可选参数0、1、2、3,代表四种模式
    'URL_HTML_SUFFIX' => 'M',

);


