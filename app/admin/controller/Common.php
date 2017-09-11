<?php

namespace app\admin\controller;

use houdun\core\Controller;

class Common extends Controller
{
	/**
	 *构造方法防止未登陆就进入界面
	 * Common constructor.
	 */
	public function __construct ()
	{
		//一加载后台界面就判断$_SESSION['admin_id']是否存在
		//如果$_SESSION['admin_id']不存在就执行跳转代码
		if (!isset($_SESSION['admin_id'])){
			//echo 1;die;
			//跳转到登录界面
			header ('location:?s=admin/login/index');
		}
	}
}