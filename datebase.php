<?php
	/*增加，删除，修改，查询*/
	class User{
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
			return $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
		}
		//关闭数据库
		function close($conn){
			mysqli_close($conn);
		}
		
		//返回数据
		function queryDate($tableName,$field,$where="",$start=0,$length=0){
			if( $this->connect() ){
				$end = $start + $length - 1;
				if( $length > 0 )
					$sql = "select {$field} where {$where} from {$tableName} limit {$start},{$end}";
				else
					$sql = "select {$field} where {$where} from {$tableName}";
				
				$this->close();
			}
		}
		
		//删除记录
		function deleteDate(){
			
		}
		//增加记录
		
		//修改记录
	}
?>
