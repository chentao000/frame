<?php
namespace app\home\controller;
use houdun\core\Controller;
use houdun\view\Base;
use houdun\view\View;
use system\model\Student;

class Entry extends Controller {
	
	public function index(){
			//测试c函数是够正确运行
		 	$user= c ('database.host');
			//dd ($user);
		
			//调用find方法
			//一个数据表对应一个模板
			$data=Student::find(1);
			dd ($data);
		
			$a='aaaa';
			//dd (compact ('a'));
			return View::with(compact ('a'))->make();
	}
	public function add(){
		//echo "add";
		//链式调用setRedirect和message
		$this->setRedirect ("?s=home/entry/index")->message ('添加成功');
	}
}