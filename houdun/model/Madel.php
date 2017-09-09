<?php
namespace houdun\model;

class Madel
{
	public function __call ($name, $arguments)
	{
		return self::parseAction ($name,$arguments);
	}
	
	public static function __callStatic ($name, $arguments)
	{
		return self::parseAction ($name,$arguments);
	}
	
	public static function parseAction($name, $arguments){
		
		$class=get_called_class ();
		//dd ($class);
		return call_user_func_array ([new Base($class),$name],$arguments);
	
	}
}