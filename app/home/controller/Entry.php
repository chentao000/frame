<?php

namespace app\home\controller;

use houdun\core\Controller;
use houdun\view\Base;
use houdun\view\View;
use system\model\Admin;

class Entry extends Controller
{
	
	public function index ()
	{
		//测试c函数是够正确运行
		//$user= c ('database.host');
		//dd ($user);

//*********************************测试根据主键查找单一数据*******************************//
		//一个数据表对应一个模板
//			$data=Admin::find(1)->toArray();
//			dd ($data);


//*********************************测试查找所有数据*******************************//
//			$data = Admin::getAll()->toArray();
//			dd ($data);

//*********************************测试where条件查找数据*******************************//
//			$data = Admin::where("cid>3")->getAll()->toArray();
//			dd ($data);

//*********************************测试where条件查找数据*******************************//
//			$data = Admin::where("cid>3")->getAll()->toArray();
//			dd ($data);


//*********************************测试汇总方法*******************************//
//			$data = Admin::count();
//			dd ($data);

//*********************************测试更新数据方法*******************************//
//			$data=[
//				"sname"=>"张三改",
//				"sex"=>"女",
//				"cid"=>10
//			];
//			$res = Admin::where("id = 1")->update($data);
//			dd ($res);

//*********************************测试删除数据方法*******************************//
		//$res = Admin::destory();//bool(false)
		//$res = Admin::destory(1);
//			$res = Admin::where("id = 1")->destory();
//			dd ($res);

//*********************************测试更新数据方法*******************************//
//		$data = [
//			"sname" => "张李四",
//			"sex" => "女",
//			"cid" => 5
//
//		];
//		$res = Admin::insert ($data);
//		dd ($res);

//*********************************测试field方法*******************************//
//			$data = Admin::field("cid")->getAll()->toArray();
//			$data = Admin::field("sname")->where("cid>3")->getAll()->toArray();
//			dd ($data);

//*********************************测试排序方法*******************************//
		
//		$data = Admin::field('sname')->where("cid>2")->order ('cid');
//		dd ($data);
		
		
		$a = 'aaaa';
		//dd (compact ('a'));
		//return View::with(compact ('a'))->make();
		return View::make ();
	}
	
	public function add ()
	{
		//echo "add";
		//链式调用setRedirect和message
		$this->setRedirect ("?s=home/entry/index")->message ('添加成功');
	}
}