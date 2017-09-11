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
	//where条件属性
	//给一个默认值空字符串防止报错
	private $where = '';
	
	//用于接受查询后的数据
	//方便全局调用
	private $data;
	
	//获取指定字段
	private $field ='';
	
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
		//dd ($class);//system\model\Admin
		//1.将接收过来的$class截取字符串   \Admin
		//2.删除'\' 		Admin
		//3.因为数据库为小写 说以需要将字符串转化为小写
		$this->table = strtolower (ltrim (strrchr ($class, '\\'), '\\'));
		//dd ($this->table);
	}
	
	/**
	 * 单一数据查询
	 * @param $id    需要查询的数据
	 * @return mixed
	 */
	public function find ($id)
	{
		//如果$this->field不为空就是指定的字段如果为空就为*
		$field = $this->field ? : '*';
		//调用获取主键字段方法赋值给$pk 用来拼接sql命令
		$pk = $this->getpk ();
		//dd ($pk);
		//echo 1;
		//拼接sql命令
		$this->where ("$pk = {$id}");
		$sql = "select {$field} from {$this->table} {$this->where}";
//		dd ($sql);
		//执行查询
		$data = $this->query ($sql);
		//如果$data不为空  那么执行下面的代码
		//防止数组为空报错
		if (!empty($data)) {
			//将转化后的数组赋值个data属性
			$this->data = current ($data);
			//返回对象
			return $this;
		}
		//如果为空直接返回对象
		return $this;
	}
	
	
	/**
	 * 查询所有数据
	 * @return $this    返回数组
	 */
	public function getAll ()
	{
		//如果$this->field不为空就是指定的字段如果为空就为*
		$field = $this->field ? : '*';
		//组合sql语句路径
		$sql = "select {$field} from {$this->table} {$this->where}";
		//执行query方法获取数据
		$data = $this->query ($sql);
		//		dd ($data);
		//如果$data不为空  那么执行下面的代码
		//防止数组为空报错
		if (!empty($data)) {
			//将数组赋值给data属性
			$this->data = $data;
			
			return $this;
		}
		return [];
	}
	
	/**
	 * 统计数据
	 * @return     mixed    数据总数
	 */
	public function count ()
	{
		//echo 1;
		//组合查询总数的sql语句
		$sql = "select count(*) as num from {$this->table} {$this->where}";
		//dd ($sql);
		$data = $this->query ($sql);
		//dd ($data);
//		Array
//		(
//			[0] => Array
//			(
//				[num] => 7
//			)
//
//		)
		//因为我们只想要最后的结果所以应该返回 num的键值
		return $data[0]['num'];
	}
	
	/**
	 * 排序方法
	 * @param string $fields	根据什么字段排序
	 * @param string $var		排序方式  默认为升序排列
	 * @return bool|mixed		返回的结果
	 */
	public function order($fields='',$var = ''){
		//$fields必须存在给一个默认值为空方便判断
		//如果没有传参数$fields那么返回false
		if (empty($fields)) return false;
		//需要显示的字段
		//如果$this->field不为空就是指定的字段如果为空就为*
		$field= $this->field ? : "*";
		//组成排序的查询语句
		$sql="select {$field} from {$this->table} {$this->where} order by {$fields} $var";
		//dd ($sql);
		//调用有结果集的查询
		$data = $this->query ($sql);
		return $data;
	}
	
	
	
	
	
	/**
	 * 更新方法
	 * @param array $data	更新的数据
	 * @return bool|mixed
	 */
	public function update (array $data)
	{//规定必须传递数组参数
		//dd ($data);
		//echo 1;
		//判断$this->where是够为空 为空终止运行
		//更新的sql语句必须有where条件
		if (empty($this->where)) return false;
		
		//声明空字符串，用来存储重组完成的结果：sname = '张三改'',sex = '女'',cid = 10
		$field = '';
		//循环$data数组组合字符串
		foreach ($data as $k => $v) {
			if (is_int ($v)) {//判读$v是否为数值类型
				//如果为数值类型那么$v不需要加''号
				$field .= "$k = $v" . ",";
			} else {//若不是数值类型就为字符串需要加''号
				$field .= "$k = '$v'" . ",";
			}
		}
		//dd ($field);//sname = '张三改',sex = '女'',
		//去除最右侧的逗号
		$field = rtrim ($field, ',');
		//dd ($field);
		//组合更新数据的sql语句
		$sql = "update {$this->table} set {$field} {$this->where}";
		//dd ($sql);
		
		//执行无结果的sql语句
		return $this->exec ($sql);
	}
	
	/**
	 * 删除数据
	 * 必须含有where条件 或者传递参数否则返回false
	 * @param string $id 主键值
	 * @return bool|mixed
	 */
	public function destory ($id = '')
	{
		//判断是够有where 或者 传参如果都没有就返回false
		if ($this->where || $id) {//如果where 和 $id 都为空那么将返回false
			//优先考虑where条件
			//如果没有where条件那么运行下面的代码
			if (empty($this->where)) {
				//获取主键给$pk
				$pk = $this->getpk ();
				//dd ($pk);
				//调用where方法
				$this->where ("{$pk} = {$id}");
			}
			//组合删除的sql语句
			$sql = "delete from {$this->table} {$this->where}";
			//dd ($sql);die;
			//返回无结果的操作exec函数
			return $this->exec ($sql);
		} else {
			return false;
		}
	}
	
	/**
	 * 添加语句
	 * @param array $data 	需要添加的数据
	 * @return mixed
	 */
	//规定数据必须以数组形式传递
	public function insert (array $data)
	{
		//dd ($data);die;
		//存储字段
		//声明空字符串，用来存储重组完成的结果：sname,sex,cid
		$fields = '';
		//存储字段的值
		//声明空字符串，用来存储重组完成的结果：'张三改','女',10
		$values = '';
		foreach ($data as $k => $v) {
			$fields .= $k . ",";
			if (is_int ($v)) {
				$values .= "$v" . ",";
			} else {
				$values .= "'$v'".",";
			}
		}
		//去除最右侧的逗号
		$values = rtrim ($values, ",");
		$fields = rtrim ($fields, ",");
		//dd ($values);
		//dd ($fields);die;
		//组合添加的sql语句
		$sql = "insert into {$this->table} ({$fields}) values ({$values})";
		//dd ($sql);
		//执行sql语句
		return $this->exec ($sql);
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
		$data = $this->query ($sql);
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
	 * 获取指定字段
	 * @param $field
	 * @return $this
	 */
	public function field($field){
		$this->field = $field;
		return $this;
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
	 * @param $sql        需要执行的sql语句
	 * @return mixed        返回查询结果的索引数组
	 * @throws Exception    抛出错误异常
	 */
	public function query ($sql)
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
	
	/**
	 * 无结果集的sql语句
	 * @param $sql        sql语句
	 * @return mixed    受影响的数量
	 * @throws Exception    抛出错误异常消息
	 */
	public function exec ($sql)
	{
		try {
			//执行sql语句
			$res = self::$pdo->exec ($sql);
			//返回受影响的数量
			return $res;
		} catch (PDOException $exception) {
			//抛出错误异常
			throw new Exception($exception->getMessage ());
		}
	}
	
	
	/**
	 * sql查询语句中的where条件
	 *
	 * @param $where    where条件
	 *
	 * @return $this
	 */
	public function where ($where)
	{
		//$this->where="where sex='男' and age>20";
		//组合where条件语句 where加参数
		$this->where = "where {$where}";
		return $this;
	}
	
	/**
	 * 将对象转化为数组
	 * @return array    转化后的数组
	 */
	public function toArray ()
	{
		//判断$this->data是否为空
		if ($this->data) {
			//不为空返回该数组
			return $this->data;
		}
		//为空返回空数组
		return [];
	}
	
}