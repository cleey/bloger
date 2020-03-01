<?php 
/**
 * 基础类，简单封装权限管理
 */
namespace admin\controller;
class base{
	function __construct(){
		$func_arr = array('dologin','loginout');
		if( POEM_CTRL == 'base' && in_array(POEM_FUNC, $func_arr) ) return;
		$this->checkLogin();
		if( IS_AJAX ){ layout(false);}
	}

	protected function checkLogin(){
		if( session('USER') != config('ADMIN_NAME') ){ 
			layout(false);
			v('public:login'); 
		}
	}

	function dologin(){
		$lc = session('logincount');
		$lc ++ ;
		session('logincount',$lc);
		if( $lc >= 5) err_jump('密码连续五次错误，请明天再试!');

		$name = gp('name|名称');
		$pass = gp('pass|密码');
		if( $name == config('ADMIN_NAME') && $pass == config('ADMIN_PASS') ){
			session('logincount',null);
			session('USER',$name);
			ok_jump('登录成功','/admin/index/index');
		}
		layout(false);
		err_jump('登录失败');
		
	}
	function loginout(){
		session('USER',null);
		layout(false);
		v('public:login');
	}

}
