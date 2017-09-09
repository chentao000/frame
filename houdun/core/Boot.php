<?php

namespace houdun\core;
class Boot
{
	/**
	 * 执行应用
	 */
	public static function run ()
	{
		self::handler();
		//初始化框架
		self::init ();
		//执行应用
		self::addRun ();
	}
	
	private static function handler(){
		$whoops = new \Whoops\Run;
		$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$whoops->register();
	}
	/**
	 * 初始化框架
	 */
	public static function init ()
	{
//		echo 'init';
		//1.声明头部
		//2.如果不声明头部,浏览器输出中文时可能会乱码
		header ("Content-type:text/html;charset=utf8");
		
		//1.设置时区
		//2.不设置时区,使用时间的时候时间可能不正确
		date_default_timezone_set ("PRC");
		
		//1.开始session
		//2.重复开启session会报错
		// 所以先判断session_id()是否存在如果存在就不重新开启session,
		//如果session_id()不存在就开启session
		session_id () || session_start ();
	}
	
	/**
	 * 执行应用
	 */
	public static function addRun ()
	{
		//echo 'addRun';/**/
		//通过地址栏参数s用来跳转需要执行的方法
		//需要传递的参数有模块/控制器/方法
		if (isset($_GET['s'])) {//地址栏中的s参数存在时
			//1.获取地址栏的s参数
			//2.s参数为字符串 需要通过/将字符串分割成数组
			$info = explode ("/", $_GET['s']);
			//dd ($info);
			//将$_GET['s']参数转化过来的数组中的值替换到路径中
			$class = "\app\\{$info[0]}\controller\\" . ucfirst ($info[1]);
			//需要调用的方法名
			$action = $info[2];
			//创建常量模板名/控制器/方法方便全局调用
			define ("MODULE", $info[0]);
			define ("CONTROLLER", $info[1]);
			define ("ACTION", $info[2]);
		} else {//地址栏中的s参数不存在时给他默认值
			//默认值$class="\app\home\controller\Entry";$action="index";
			$class = "\app\home\controller\Entry";
			$action = "index";
			//创建常量模板名/控制器/方法方便全局调用
			define ("MODULE", "home");
			define ("CONTROLLER", 'Entry');
			define ("ACTION", "index");
		}
		//(new $class)->$action();上面代码相当于new实例化类
		echo call_user_func_array ([new $class, $action], []);
	}
}