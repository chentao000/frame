<?php
namespace system\model;

use houdun\model\Madel;

/**
 * 后台登录类
 * Class Admin
 * @package system\model
 */
class Admin extends Madel {
	
	/**
	 * 登录验证
	 * @param $data
	 */
	public function login($data)
	{
		$admin_username = $data['admin_username'];
		$admin_password = $data['admin_password'];
		$captcha = $data['captcha'];
		//数据验证
		//return ['code'=>0,'msg'=>'请输入用户名']
		//code 标识成功还是失败的标识 1代表成功，0代表失败
		//msg 提示消息
		//判断用户名是否为空
		//如果不匹配返回'code'=>0,'msg'=>'请输入用户名
		if (!trim ($admin_username)) return ['code'=>0,'msg'=>'请输入用户名'];
		//dd ($data);
		//判断密码是否为空
		//如果不匹配返回'code'=>0,'msg'=>'请输入密码'
		if (!$admin_password) return ['code'=>0,'msg'=>'请输入密码'];
		//判断验证码是否为空
		//如果不匹配返回'code'=>0,'msg'=>'请输入验证码
		if (!trim ($captcha)) return ['code'=>0,'msg'=>'请输入验证码'];
		
		//读取数据库数据
		//根据past传递过来的admin_username进行查找
		$userinfo = $this->where(" admin_username = '{$admin_username}'")->getAll();
		//$userinfo =$userinfo->toArray();
		//dd($userinfo);die;
		//如果返回的$userinfo为空数据
		//那么登录失败返回'code'=>0,'msg'=>'您输入的用户名不存在'
		if (empty($userinfo)) return ['code'=>0,'msg'=>'您输入的用户名不存在'];
		
		//将$userinfo对象转化为数组
		$userinfo = $userinfo->toArray();
		//dd($userinfo);die;
		//通过password_verify判断密码是否能够匹配
		//如果不匹配说明密码不正确
		//那么登录失败返回'code'=>0,'msg'=>'密码错误'
		if (!password_verify ($admin_password,$userinfo[0]['admin_password'])) return ['code'=>0,'msg'=>'您输入的密码不正确'];
		
		//验证验证码是否匹配
		//通过$_SESSION['phrase']来判断
		//如果不相等那么返回'code'=>0,'msg'=>'验证码不正确'
		if ($_SESSION['phrase'] != $captcha) return ['code'=>0,'msg'=>'验证码不正确'];
		
		//将信息存到session中
		$_SESSION['admin_id'] = $userinfo[0]['id'];
		$_SESSION['admin_username'] = $userinfo[0]['admin_username'];
		return ['code'=>1,'msg'=>'登录成功'];
	}
	
	/**
	 * 退出方法
	 */
	public function out()
	{
		//清除所有session资源
		session_unset ();
		session_destroy ();
		$_SESSION['phrase']='';
	}
	
	public function edit($data)
	{
		//dd (password_hash ('admin888',PASSWORD_DEFAULT));die;
		//dd ($data);die;
		//获取post数据
		$admin_password = $data['admin_password'];
		$newpassword1 = $data['newpassword1'];
		$newpassword2 = $data['newpassword2'];
		//数据验证
		//return ['code'=>0,'msg'=>'请输入用户名']
		//code 标识成功还是失败的标识 1代表成功，0代表失败
		//msg 提示消息
		//dd ($data);
		//判断密码是否为空
		//如果不匹配返回'code'=>0,'msg'=>'请输入密码'
		if (!$admin_password) return ['code'=>0,'msg'=>'请输入密码'];
		
		//判断密码是否为空
		//如果不匹配返回'code'=>0,'msg'=>'请输入密码'
		if (!$newpassword1) return ['code'=>0,'msg'=>'请输入新密码'];
		
		//判断密码是否为空
		//如果不匹配返回'code'=>0,'msg'=>'请输入密码'
		if (!$newpassword2) return ['code'=>0,'msg'=>'请确认新密码'];
		
		//读取数据库数据
		//根据past传递过来的admin_username进行查找
		$userinfo = $this->find($_SESSION['admin_id'])->toArray();
		//$userinfo =$userinfo->toArray();
		
		//dd($userinfo);die;
		//通过password_verify判断密码是否能够匹配
		//如果不匹配说明密码不正确
		//那么登录失败返回'code'=>0,'msg'=>'密码错误'
		if (!password_verify ($admin_password,$userinfo['admin_password'])) return ['code'=>0,'msg'=>'您输入的密码不正确'];
		
		//通过password_verify判断密码是否能够匹配
		//如果不匹配说明密码不正确
		//那么登录失败返回'code'=>0,'msg'=>'密码错误'
		
		if (password_verify ($newpassword1,$userinfo['admin_password'])) return ['code'=>0,'msg'=>'您输入的新旧密码相同'];
		
		//通过password_verify判断密码是否能够匹配
		//如果不匹配说明密码不正确
		//那么登录失败返回'code'=>0,'msg'=>'密码错误'
		if ($newpassword1 != $newpassword2) return ['code'=>0,'msg'=>'您两次输入的新密码不相同'];
		$admin_password = password_hash ($newpassword2,PASSWORD_DEFAULT);
		//dd (compact ('admin_password'));die;
		$this->where("id = {$_SESSION['admin_id']}")->update(compact ('admin_password'));
		return ['code'=>1,'msg'=>'修改成功'];
	}
}