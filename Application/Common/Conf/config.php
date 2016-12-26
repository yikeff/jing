<?php
return array(
	//'配置项'=>'配置值'
  /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'ele_shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sw_',    // 数据库表前缀
    //路径常量
  'TMPL_PARSE_STRING' => array(
      '__ADMIN__' => __ROOT__.'/Public/Admin',
      '__HOME__'  => __ROOT__.'/Public/Home'
    )
);