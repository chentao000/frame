<?php
namespace houdun\core;

class Controller
{
	//定义调转地址属性
	//给$url一个默认属性让他返回上一级
	private $url="history.back()";
	
	/**
	 * 加载成功提示模板
	 * @param $message 成功提示
	 * @return $this
	 */
	public function message($message){
		
		include './view/message.php';
		exit;
	}
	
	/**
	 * 跳转
	 * @param string $url	跳转路径
	 * @return $this
	 */
	//给$url一个空数组做判断
	public function setRedirect($url=''){
		//判断$url是够传参如果没有就返回上一级
		if (empty($url)){
			//返回上一级
			$this->url = "history.back()";
		}else{//如果$url传参那么久跳转到指定的路径
			$this->url = "location.href='$url'";
		}
		return $this;
	}
	
}