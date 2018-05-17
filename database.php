<?php
/*数据库增加，删除，修改，查询*/
/*
 * 对象名：Database
 * 成员变量 
 *   $DB_HOST  数据库主机
 *   $DB_USER  数据库用户名
 *   $DB_PASSWORD  数据库密码
 *   $DB_NAME  数据库名
 *
 * 成员函数
 *   setHeader  设置数据库头
 *     @param  $DB_HOST
 *     @param  $DB_USER
 *     @param  $DB_PASSWORD
 *     @param  $DB_NAME
 *
 *   connect  连接数据库
 *     @return  数据库连接头
 *
 *   close  关闭数据库
 *     @param  $con  数据库头
 *
 *   queryData  查询数据
 *     @param  $sql  查询语句  string
 *     @return  $arr  二维关联数组数据  array
 *
 *   deleteData  删除数据
 *     @param  $table  表名  string
 *     @return  $flag  是否  bool
 *
 *   insertData  增加数据
 *     @param  $table  表名  string
 *     @param  $fieldVal  一维关联数组  array
 *     @return  $flag  是否  bool
 *
 *   updateData  修改数据
 *     @param  $table  表名  string
 *     @param  $fieldVal  一维关联数组  array
 *     @param  $where  条件  default:""  string
 *     @return  $flag  是否  bool
 *
 *   existData  判断数据是否存在
 *     @param  $table  表名  string
 *     @param  @fieldVal  一维关联数组  array
 *     @return  $flag  是否  bool
 *
 *   countData  查询记录条数
 *     @param  $table  表名  string
 *     @param  $key  关键词  string
 *     @param  $where  条件  string
 *     @return  $num  数量  int
 */
	class Database{
		var $DB_HOST = "localhost";
		var $DB_USER = "root";
		var $DB_PASSWORD = "root";
		var $DB_NAME = "db";
		
		//设置数据库头
		function setHeader($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME){
			$this->DB_HOST = $DB_HOST;
			$this->DB_USER = $DB_USER;
			$this->DB_PASSWORD = $DB_PASSWORD;
			$this->DB_NAME = $DB_NAME;
		}
		//连接数据库
		function connect(){
			return @$conn = mysqli_connect($this->DB_HOST,$this->DB_USER,$this->DB_PASSWORD,$this->DB_NAME);
		}
		//关闭数据库
		function close($conn){
			@mysqli_close($conn);
		}
		
		//返回数据//二维
		function queryData($sql){
			$arr = array();
			if( $con = $this->connect() ){
				$res = @mysqli_query($con,$sql);
				if( $res )
					while( $row = mysqli_fetch_assoc($res) ){
						array_push($arr,$row);
					}
				$this->close($con);
			}
			return $arr;
		}
		
		//删除记录
		function deleteData($table,$where=""){
			$flag = false;
			if( $con = $this->connect() ){
				$sql = "delete from {$table}";
				if( $where != "" ){
					$sql .= " where {$where}";
				}
				if( mysqli_query($con,$sql) ){
					$flag = true;
				}
				$this->close($con);
			}
			return $flag;
		}
		//增加记录
		function insertData($table,$fieldVal){
			$flag = false;
			if( $con = $this->connect() ){
				$len = count($fieldVal);
				$Field = "";
				$Val = "";
				foreach($fieldVal as $key => $val){
					$len--;
					$Field .= "{$key}";
					$Val .= "'{$val}'";
					if($len>0){
						$Field .= ",";
						$Val .= ",";
					}
				}
				$sql = "insert {$table}({$Field}) values({$Val})";
				if( mysqli_query($con,$sql) ){
					$flag = true;
				}
				$this->close($con);
			}
			return $flag;
		}
		//修改记录
		function updateData($table,$fieldVal,$where=""){
			$flag = false;
			if( $con = $this->connect() ){
				$sql = "update {$table} set ";
				$len = count($fieldVal);
				foreach($fieldVal as $key => $val){
					$len--;
					$sql .= "{$key}='{$val}'";
					if($len>0){
						$sql .= ",";
					}
				}
				if( $where != "" ) $sql .= " where {$where}";
				if( mysqli_query($con,$sql) ){
					$flag = true;
				}
				
				$this->close($con);
			}
			return $flag;
		}
		//记录是否存在
		function existData($table,$fieldVal){
			$flag = false;
			if( $con = $this->connect() ){
				$sql = "select 1 from {$table} where ";
				$len = count($fieldVal);
				foreach($fieldVal as $key => $val){
					$len--;
					$sql .= "{$key}='{$val}'";
					if($len>0){
						$sql .= " and ";
					}
				}
				$sql .= " limit 1";
				if( $res = mysqli_query($con,$sql) ){
					if( $row = mysqli_fetch_assoc( $res ) ){
						$flag = true;
					}
				}
				$this->close($con);
			}
			return $flag;
		}
		//记录条数
		function countData($table,$key,$where=""){
			$num = 0;
			if( $con = $this->connect() ){
				$sql = "select {$key} from {$table}";
				if($where != ""){
					$sql .= " where {$where}";
				}
				$res = mysqli_query($con,$sql);
				$num = $res->num_rows;
			}
			return intval($num);
		}
	}
?>
