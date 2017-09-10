<?php

namespace app\home\controller;

use houdun\core\Controller;
use houdun\view\Base;
use houdun\view\View;
use system\model\Student;

class Entry extends Controller
{
	
	public function index ()
	{
		//测试c函数是够正确运行
		//$user= c ('database.host');
		//dd ($user);

//*********************************测试根据主键查找单一数据*******************************//
		//一个数据表对应一个模板
//			$data=Student::find(1)->toArray();
//			dd ($data);


//*********************************测试查找所有数据*******************************//
//			$data = Student::getAll()->toArray();
//			dd ($data);

//*********************************测试where条件查找数据*******************************//
//			$data = Student::where("cid>3")->getAll()->toArray();
//			dd ($data);

//*********************************测试where条件查找数据*******************************//
//			$data = Student::where("cid>3")->getAll()->toArray();
//			dd ($data);


//*********************************测试汇总方法*******************************//
//			$data = Student::count();
//			dd ($data);

//*********************************测试更新数据方法*******************************//
//			$data=[
//				"sname"=>"张三改",
//				"sex"=>"女",
//				"cid"=>10
//			];
//			$res = Student::where("id = 1")->update($data);
//			dd ($res);

//*********************************测试删除数据方法*******************************//
		//$res = Student::destory();//bool(false)
		//$res = Student::destory(1);
//			$res = Student::where("id = 1")->destory();
//			dd ($res);

//*********************************测试更新数据方法*******************************//
//		$data = [
//			"sname" => "张李四",
//			"sex" => "女",
//			"cid" => 5
//
//		];
//		$res = Student::insert ($data);
//		dd ($res);

//*********************************测试field方法*******************************//
//			$data = Student::field("cid")->getAll()->toArray();
//			$data = Student::field("sname")->where("cid>3")->getAll()->toArray();
//			dd ($data);

//*********************************测试排序方法*******************************//
		
		$data = Student::field('sname')->where("cid>2")->order ('cid');
		dd ($data);
		
		
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