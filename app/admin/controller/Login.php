<?php

namespace app\admin\controller;

use houdun\core\Controller;
use houdun\view\View;
use system\model\Admin;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

/**
 * 后台登录类
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller
{
	
	public function index()
	{
		//生成加密后的密码加入手动加入数据库中
		//dd (password_hash ('admin888',PASSWORD_DEFAULT));
		
		//测试验证码
		//$this->captcha ();
		//dd ($_SESSION['phrase']);
		if (IS_POST){//判断是够点击提交按钮
			//echo 1;die;
			//实例化Admin类
			//调用login方法
			$res=(new Admin())->login ($_POST);
			//dd ($res);
			//根据$res['code']的值判断是否登录成功
			if ($res['code']){//为1时登录成功跳转到主页
				//跳转主页并成功提示
				$this->setRedirect (u ('entry.index'))->message ($res['msg']);
			}else{//为0时返回上一级
				//跳转登录页面并提供登录错误原因
				$this->setRedirect ()->message ($res['msg']);
			}
		}
		//加载模板文件
		return View::make();
	}
	
	public function captcha()
	{
		header('Content-type: image/jpeg');
		$phraseBuilder = new PhraseBuilder(4);
		$builder = new CaptchaBuilder(null, $phraseBuilder);
		$builder->build();
		//将验证码存到session中
		$_SESSION['phrase'] = $builder->getPhrase();
		$builder->output();
	}
}