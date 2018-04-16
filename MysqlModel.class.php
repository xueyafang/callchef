<?php
	//INCLUDE './DBCONGI.PHP';

	//定义数据操作类
	class MysqlModel{
		//成员属性
		//数据库链接地址
		protected $host;
		//数据库用户名
		protected $user;
		//数据库密码
		protected $pwd;
		//要操作的表名
		protected $tabName;
		//表前缀
		protected $prefix;
		//要操作的数据库
		protected $dbname;
		//字符集
		protected $charset;
		//数据库链接资源
		protected $link = null;
		//保存sql语句
		private $sql;
		//定义缓存文件路径
		public $cache;
		//定义一个where
		protected $where;
		protected $order;
		protected $limit;
		protected $field;
		protected $method = array('where','order','limit','field');
		//成员方法
		//构造方法   初始化成员属性 以及链接数据库
		function __construct($tabName = '',$cache = './cache/'){
			//第一次初始化数据库配置属性
			$this->host = DB_HOST;
			$this->user = DB_USER;
			$this->pwd = DB_PWD;
			$this->charset = DB_CHARSET;
			$this->prefix = DB_PREFIX;
			$this->dbname = DB_NAME;
			$this->cache = $cache;
			//判断是否传入表名 如果传入表名则用传入的 如果没有传入表名 需要自己获取表名
			if($tabName == ''){
				//获取表名;  get_class 获取当前对象的类名  UserModel
				//1.截取  获取User
				//2.转换小写
				$this->tabName = strtolower(substr(get_class($this),0,-5));
			}else{
				$this->tabName = $tabName;
			}
			//初始化数据库链接
			$this->link = $this->connect();

		}
		//1.定义链接数据库的方法
		protected function connect(){
			//链接数据库
			$link = @mysqli_connect($this->host,$this->user,$this->pwd,$this->dbname);
			//判断
			if(!$link){
				return false;
			}
			//设置字符集
			mysqli_set_charset($link,$this->charset);
			return $link;
		}
		/***********获取数据表中合法字段*****************/
		function getField(){
			//设置缓存文件路径
			$pathInfo = $this->cache.$this->tabName.'Cache.php';
			if(file_exists($pathInfo)){
				return include $pathInfo;
			}else{
				$sql = 'DESC '.$this->prefix.$this->tabName;
				$result = $this->query($sql);
				//var_dump($result);
				//调用写入字段保存的方法
				//echo 111;
				return $this->writeField($result);
			}


		}
		//生成字段缓存的方法
		function writeField($data){
			//1.判断缓存路径是否存在
			if(!file_exists($this->cache)){
				mkdir($this->cache);
			}
			//1.1处理路径最后的斜线部分
			$this->cache = rtrim($this->cache,'/').'/';
			//2.设置生成缓存的路径
			$pathInfo = $this->cache.$this->tabName.'Cache.php';
			//echo $pathInfo;
			$fields = array();
			//3.遍历数组 获取 数组中的 主键  和  自增  以及每一个字段名
			foreach($data as $key=>$val){
				//获取主键
				if($val['Key'] == 'PRI'){
					$fields['_pk'] = $val['Field'];
				}
				//获取自增键
				if($val['Extra'] == 'auto_increment'){
					$fields['_auto'] = $val['Field'];
				}
				//获取字段名
				$fields[] = $val['Field'];
			}
			//var_dump($fields);
			file_put_contents($pathInfo,"<?php\r\n return ".var_export($fields,true)."\r\n?>");
			//var_export 原样输入或者保留字符串
			//如果设置第二个参数 才会保留
			return $fields;

		}
		//定义查询的SQL语句
		private function query($sql){
			//清除所有条件
			$this->clearWhere();
			//保存SQL语句(为了后期拍错)
			$this->sql = $sql;
			$rows = array();
			$result = mysqli_query($this->link,$sql);
			if($result && mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){
					//将查询到的数据装入一个数组中
					$rows[] = $row;
				}
				return $rows;
			}else{
				return false;
			}
		}
		//定义增、删、改、发送的SQL方法
		private function exec($sql){
			//清除所有条件
			$this->clearWhere();
			//保存SQL语句
			$this->sql = $sql;
			//发送
			$result = mysqli_query($this->link,$sql);
			if($result && mysqli_affected_rows($this->link)>0){
				return mysqli_insert_id($this->link)?mysqli_insert_id($this->link):mysqli_affected_rows($this->link);
			}else{
				return false;
			}

		}
		// 在对象外部可以调用 定义添加的方法
		public function insert(array $data){
			//制作SQL语句
			//var_dump($data);
			$key = '';
			$val = '';
			//获取缓存字段
			$field = $this->getField();
			foreach($data as $k=>$v){
				//判断当前遍历的下标(字段名)是否在缓存的合法字段中出现
				if(in_array($k,$field)){
					$key .= '`'.$k.'`,';
					$val .= '"'.$v.'",';
				}
			}
			$key = rtrim($key,',');
			$val = rtrim($val,',');
			//echo $key.'<br/>'.$val;
			$sql = "INSERT INTO {$this->prefix}{$this->tabName}({$key}) VALUES({$val})";
			//echo $sql;
			return $this->exec($sql);
		}
		//定义一个魔术方法 call 调用一个不存在的方法时 自动触发
		function  __call($methodName,$args){
			//验证用户调用的方法是否在我预设的方法中
			if(in_array($methodName,$this->method)){
				//判断用户是否调用where()方法
				if($methodName == 'where'){
					$this->where = isset($args[0])?$args[0]:'';
					//下面是按照指定字段
				}elseif($methodName == 'field'){
					$this->field = $args;
				}elseif($methodName == 'limit'){
					if(count($args)>1){
						$this->limit = $args[0].','.$args[1];
					}else{
						$this->limit = $args[0];
					}
				}elseif($methodName == 'order'){
					$this->order = $args[0];
				}
			}
			return $this;
		}
		//触发__get()
		function __get($name){
			if($name == 'sql'){
				echo $this->$name;
			}
		}
		//删除
		function delete(){
			//var_dump($this->where);
			if(!empty($this->where)){
				$where = ' WHERE '.$this->where;
			}else{
				$where = '';
				//如果用户没有传入删除条件，自动判断get数组中是否有主键，如果有 则删除该键 $_GET['id'] = 22;
				if(!empty($_GET)){
					//先获取缓存字段
					$field = $this->getField();
					//var_dump($field);
					//在缓存字段中获取主键
					$id = $field['_pk'];

					foreach($_GET as $k=>$v){
						if($id == $k){
							$val = $v;
							//id = 2;
						}
					}
					$where = ' WHERE '.$id. '=' .$val;

				}
			}
			$sql  = "DELETE FROM {$this->prefix}{$this->tabName} {$where}";
			//注意：如果没有传入条件并且get方式中也没有符合条件 则整张表的数据将会全部删除
			//echo $sql;
			//执行语句  并且 返回执行结果
			return $this->exec($sql);
		}
		//修改
		public function update(array $data){
			//调用获取合法字段方法
			$field = $this->getField();
			$update = '';
			foreach($data as $k=>$v){
				//过滤非法字段
				if(in_array($k,$field) && $k != $field['_pk']){
					$update .= '`'.$k.'`="'.$v.'",';
				}elseif($k == $field['_pk']){
					$con = '`'.$k.'`= "'.$v.'"';
				}

			}
			//过滤最后的逗号
			$update = rtrim($update,',');
			//判断是否有where条件
			if(!empty($this->where)){
				//有条件
				$where = ' WHERE '.$this->where;
			}else{
				//获取传入数组中的主键
				$where = ' WHERE '.$con;
			}
			//echo $update;
			//拼接sql语句
			$sql = "UPDATE {$this->prefix}{$this->tabName} SET {$update} {$where}";
			//echo $sql;
			return $this->exec($sql);
		}

		//查询
		public function select(){
			$limit = $where = $order = '';
			//判断用户是否传入limit
			if(!empty($this->limit)){
				$limit = ' LIMIT '.$this->limit;
			}
			//判断是否传入where
			if(!empty($this->where)){
				$where = ' WHERE '.$this->where;
			}
			//判断是否传入order
			if(!empty($this->order)){
				$order = ' ORDER BY '.$this->order;
			}
			//判断用户是否需要查询指定的字段
			if(!empty($this->field)){
				//获取合法字段
				$field = $this->getField();
				//过滤安全字段
				$hefa = array_intersect($this->field,$field);
				//拼接字符串
				$fields = implode(',',$hefa);
				//var_dump($hefa);
			}else{
				//为空 用户不需要查询指定字段
				$fields = '*';
			}
			$sql = "SELECT {$fields} FROM {$this->prefix}{$this->tabName} {$where} {$order} {$limit}";
			//select * from user WHERE ORDER LIMIT
			//echo $sql;
			return $this->query($sql);
		}
		//r_select 多表联合查询
		public function r_select($tabName1,$tabName2){
			//1.获取需要多表联合查询的所有表名
			$args = func_get_args();
			//2.拼接表名
			$tabNames = implode(',',$args);
			$fields = $where = $limit = $order = '';
			//3.获取查询的字段
			if(!empty($this->field)){
				$fields = $this->field;
			}

			/**********过滤安全字段***********/
			foreach($args as $k=>$v){
				//将遍历的表名 赋值给成员属性 tabname(getField只会获取 $this->tabName);
				$this->tabName = $v;
				//获取合法字段
				$this->getField();
			}
			//遍历传入的实参数组  得到每个表中对应字段
			foreach($args as $k=>$v){
				$cache = './cache/'.$v.'Cache.php';
				$arr = include $cache;
				foreach($arr as $key=>$val){
					//将表名和安全字段拼接到一块
					$num[] = $v.'.'.$val;
				}
			}
			//进行安全字段验证
			//$keys = array();
			//var_dump($fields);exit;
			//user.username
			$keys = array();
			foreach($fields as $k=>$v){
				if(strchr($v,' as ',true) && in_array(strchr($v,' as ',true),$num)){
					//合法的
					$keys[] = $v;
				}elseif(in_array($v,$num)){
					$keys[] = $v;
				}
			}
			if(empty($keys)){
				//检测多个表中是否有重复的字段名 如果有 自动给加上
				$keys[] = '*';
			}
			//var_dump($fields);exit;
			//var_dump($num);var_dump($fields);exit;

			//4.判断是否设置where
			if(!empty($this->where)){
				$where = ' WHERE '.$this->where;
			}
			//5.判断是否设置limit
			if(!empty($this->limit)){
				$limit = ' LIMIT '.$this->limit;
			}
			//6.判断是否设置order
			if(!empty($this->order)){
				$order = ' ORDER BY '.$this->order;
			}
			//转成字符串
			$fieldsStr = implode(',',$keys);
			//echo $fieldsStr;

			//组装SQL语句
			$sql = "SELECT {$fieldsStr} FROM {$tabNames} {$where} {$order} {$limit}";
			//echo $sql;exit;

			return $this->query($sql);

		}
		//获取数据的总条数
		function total(){
			$where = '';
			if(!empty($this->where)){
				$where = ' WHERE '.$this->where;
			}
			//获取主键
			$field = $this->getField();
			if(isset($field['_pk'])){
				$pk = $field['_pk'];
			}else{
				$pk = '*';
			}
			//组装SQL语句
			$sql = "SELECT COUNT({$pk}) as total FROM {$this->prefix}{$this->tabName} {$where}";
			return intval($this->query($sql)[0]['total']);
		}
		//查询单条数据  返回一维数组
		public function find(){
			$where = '';
			//判断是否传入where
			if(!empty($this->where)){
				$where = ' WHERE '.$this->where;
			}
			//判断用户是否需要查询指定的字段
			if(!empty($this->field)){
				//获取合法字段
				$field = $this->getField();
				//过滤安全字段
				$hefa = array_intersect($this->field,$field);
				//拼接字符串
				$fields = implode(',',$hefa);
				//var_dump($hefa);
			}else{
				//为空 用户不需要查询指定字段
				$fields = '*';
			}
			$sql = "SELECT {$fields} FROM {$this->prefix}{$this->tabName} {$where} LIMIT 1";
			//返回一个一维数组
			return $this->query($sql)[0];
		}
		//清除条件
		function clearWhere(){
			$this->where = '';
			$this->limit = '';
			$this->order = '';
			$this->field = '';
		}
		//析构方法
		function  __destruct(){
			if($this->link != null){
				mysqli_close($this->link);
			}
		}

	}

	// include './dbconfig.php';
	// $user = new MysqlModel();
	/*

	 //连贯操作*/
	//$user->where('id=1')->delete();
	/*$user->field('id,name,sex')->where('id=10')->select();   *
	 */



	// function select($field = '',$where ='',$order ='',$limit=''){

	// }

	//select('','','','1,3');
	//limit(1,3)->select();