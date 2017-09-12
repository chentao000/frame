<?php
/**
 * 助手函数
 */

/**
 * 定义常量判断是否为post请求
 */
define ('IS_POST', $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);

/**
 * 检测请求是否为ajax请求
 */
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	//是异步请求
	define ('IS_AJAX', true);
} else {
	define ('IS_AJAX', false);
}

if (!function_exists ('dd')) {
	/**
	 * 打印函数
	 */
	function dd ($var)
	{
		echo "<pre style='background: #ccc;padding: 8px;border-radius: 5px'>";
		//print_r打印函数，不显示数据类型
		//print_r不能打印null，boolen
		if (is_null ($var)) {
			var_dump ($var);
		} elseif (is_bool ($var)) {
			var_dump ($var);
		} else {
			print_r ($var);
		}
		echo '</pre>';
	}
}

if (!function_exists ('c')) {
	/**
	 *连接数据库
	 * database.host
	 * @param $var
	 * @return null
	 */
	function c ($var)
	{
		$info = explode ('.', $var);
		//dd ($info);
		$data = include "../system/config/" . $info[0] . ".php";
//		dd ($data);
		return isset($data[$info[1]]) ? $data[$info[1]] : null;
	}
}

if (!function_exists ('u')) {
	
	function u ($url,$args=[])
	{
		//dd($url);
        $args = http_build_query($args);
		$info = explode ('.',$url);
		//dd($info);
		if(count ($info)==2){
			return "index.php?s=".MODULE."/{$info[0]}/{$info[1]}"."&$args";
		}
		if(count ($info)==1){
			return "index.php?s=".MODULE."/".CONTROLLER."/{$info[0]}"."&$args";
		}
		return "index.php?s={$info[0]}/{$info[1]}/{$info[2]}"."&$args";
	}
}