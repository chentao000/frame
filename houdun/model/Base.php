<?php

namespace houdun\model;

use PDOException;
use Exception;
use PDO;

class Base
{
	//定义一个$pdo属性默认值为null
	//为了判断是够连接数据库和方便与全局调用
	private static $pdo = null;
	//用于接收操作数据表的名称
	private $table;
	
	/**
	 * 构造方法 用来连接数据库
	 * Base constructor.
	 */
	public function __construct ($class)
	{
		//1.连接数据库
		if (is_null (self::$pdo)) {
			self::connect ();
		}
		//dd ($class);//system\model\Student
		//1.将接收过来的$class截取字符串   \Student
		//2.删除'\' 		Student
		//3.因为数据库为小写 说以需要将字符串转化为小写
		$this->table = strtolower (ltrim (strrchr ($class, '\\'), '\\'));
		//dd ($this->table);
	}
	
	/**
	 * 单一数据查询
	 * @param $id	需要查询的数据
	 * @return mixed
	 */
	public function find ($id)
	{
		//调用获取主键字段方法赋值给$pk 用来拼接sql命令
		$pk = $this->getpk ();
		//dd ($pk);
		//echo 1;
		//拼接sql命令
		$sql = "select * from " . $this->table . " where " . $pk . " =" . $id;
		//dd ($sql);
		//执行查询
		$data = self::query ($sql);
		//dd (current ($data));
		return current ($data);
	}
	
	/**
	 * 获取表中id的字段
	 * @return string
	 */
	public function getpk ()
	{
		//获取表字段
		$sql = "desc " . $this->table;
		//调用query方法获取查找出来的数据赋值给$data
		$data = self::query ($sql);
		//dd ($data);
		$pk = '';//给$pk一个空字符串用于接受主键字段
		//循环$data数组查找主键字段
		foreach ($data as $v) {
			//1.判断主键字段
			//只有主键字段的Key含有PRI
			if ($v['Key'] == "PRI") {
				//echo 1;
				//将键名为Field的键值交给$pk并结束循环
				$pk = $v['Field'];
				break;
			}
		}
		//将$pk的值返回出去
		return $pk;
	}
	
	
	/**
	 * 连接数据库
	 * @throws Exception    抛出错误异常
	 * 注意PDO/Exception/PDOException都是系统自带的方法需要
	 * use 出来
	 */
	private static function connect ()
	{
		try {
			//调用c函数将主机名/服务器地址/数据库名/用户/密码全部替换
			//如果需要修改sql就去database.php中修改参数
			//便于优化
			$dsn = c ("database.driver") . ":host=" . c ("database.host") . ";dbname=" . c ("database.dbname");
			$user = c ("database.user");
			$password = c ("database.password");
			//连接数据库
			self::$pdo = new PDO($dsn, $user, $password);
			//设置字符集
			self::$pdo->query ("set names utf8");
			//设置错误命令消息
			self::$pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $exception) {
			//抛出错误异常
			throw new Exception($exception->getMessage ());
		}
	}
	
	/**
	 * 执行有结果集的查询
	 * @param $sql		需要执行的sql语句
	 * @return mixed		返回查询结果的索引数组
	 * @throws Exception	抛出错误异常
	 */
	private static function query ($sql)
	{
		try {
			//执行sql语句
			$res = self::$pdo->query ($sql);
			//返回查询结果的索引数组
			return $row = $res->fetchAll (PDO::FETCH_ASSOC);
		} catch (PDOException $exception) {
			//抛出错误异常
			throw new Exception($exception->getMessage ());
		}
	}
	
	
}