<?php

namespace houdun\view;

class Base
{
	//存放数据
	//extract ();需要的参数是一个数组
	//防止在Entry.php中调用with时没有传参数或着不需要分配变量不调用with时报错
	//所以需要给$data一个默认值为空数组
	protected $data = [];
	//存放模板路径
	protected $file;
	
	/**
	 * 分配变量
	 * @param $var 需要传递的参数
	 * @return $this
	 */
	public function with ($var)
	{
		//$var 通过Entry.php调用with传递过来
		//		dd ($var);
		//		Array
		//		(
		//			[a] => aaaa
		//		)
		//将传递过来的数据赋值给data
		$this->data = $var;
		return $this;
	}
	
	public function make ()
	{
		//dd (MODULE);//home
		//dd (CONTROLLER);//Entry
		//dd (ACTION);//index
		//dd ("../app/".MODULE."/view/".strtolower (CONTROLLER)."/".ACTION.".php");//../app/home/view/entry/index.php
		
		//通过定义的常量来组合路径
		//组合的路径根据get参数s变化
		$this->file = "../app/" . MODULE . "/view/" . strtolower (CONTROLLER) . "/" . ACTION . ".".c ("view.suffix");
		//dd ($this->file);die;
		return $this;
	}
	
	/**
	 * 当echo 输出对象时触发
	 * echo对象就是Boot中的echo对象
	 * @return string
	 */
	public function __toString ()
	{
//		echo 1;
//		dd ($this->data);
		//将$this->data的值转化为变量
		extract ($this->data);
		//dd ($this->file);die;
		//引入欢迎界面
		include $this->file;
		return '';
	}
	
}