<?php

namespace app\admin\controller;

use houdun\view\View;
use system\model\Admin;

class Entry extends Common
{
	/**
	 * 主页
	 * @return mixed
	 */
	public function index(){
		//dd (CONTROLLER);die;
		//引用模板文件
		$username=$_SESSION['admin_username'];
		return View::with(compact ('username'))->make();
		
	}
	
	/**
	 * 退出
	 */
	public function out()
	{
		(new Admin())->out ();
		$this->setRedirect()-> message('退出成功') ;
		exit;
	}
	
	/**
	 * 修改密码
	 * @return mixed
	 */
	public function edit()
	{
		if (IS_POST){//判断是够点击提交按钮
			//echo 1;die;
			//实例化Admin类
			//调用login方法
			$res=(new Admin())->edit ($_POST);
			//dd ($res);
			//根据$res['code']的值判断是否登录成功
			if ($res['code']){//为1时登录成功跳转到主页
				//跳转主页并成功提示
				//清除session
				(new Admin())->out ();
				$this->setRedirect (u ('entry.index'))->message ($res['msg']);
			}else{//为0时返回上一级
				//跳转登录页面并提供登录错误原因
				$this->setRedirect ()->message ($res['msg']);
			}
		}
		//加载模板文件
		return View::make();
	}
}