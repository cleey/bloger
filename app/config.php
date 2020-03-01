<?php 
/**
 * 公共（全局）配置文件
 */

return array(
	'db_type'   => 'mysql', //数据库类型
	'db_name'   => 'sharehavecom', // 数据库名 
	'db_host'   => 'localhost', // 服务器地址
	'db_user'   => 'root', // 用户名
	'db_pass'    => 'password123', // 密码 
	'db_port'   => 3306, // 端口
	'db_prefix' => 'sh_', // 数据库表前缀

	'layout'=> 'public:layout',

	// 后台登录密码
	'ADMIN_NAME' => 'admin',
	'ADMIN_PASS' => '123123123',
);
