<?php
namespace houdun\view;

class View
{
	/**
	 * 调用不存在的方法名时触发
	 * @param $name  		不存在的方法名
	 * @param $arguments	方法参数
	 *
	 * @return mixed
	 */
	public  function __call ($name, $arguments)
	{
		return self::parseAction ($name,$arguments);
	}
	
	/**
	 * 静态调用不存在的方法名时触发
	 * @param $name  		不存在的方法名
	 * @param $arguments	方法参数
	 *
	 * @return mixed
	 */
	public static function __callStatic ($name, $arguments)
	{
		return self::parseAction ($name,$arguments);
	}
	
	/**
	 * 自定义方法调用Base
	 * @param $name  		调用的方法名
	 * @param $arguments	方法参数
	 *
	 * @return mixed
	 */
	public static function parseAction($name,$arguments)
	{
		return call_user_func_array ([new Base,$name],$arguments);
	}
}