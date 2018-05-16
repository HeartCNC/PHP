<?php
	class E_time{
		var $nowTimeStr;  //当前时间字符串
		var $nowTimeStamp;  //当前时间戳
		function init(){
			date_default_timezone_set('PRC');
			$this->nowTimeStr = date("Y-m-d H:i:s");
			$this->nowTimeStamp = time();
		}
		//计算两个时间的差值绝对值
		function timeDis($endTimeStr,$startTimeStr=""){
			if($startTimeStr == "") $startTimeStr=$this->nowTimeStr;
			$end = strtotime($endTimeStr);
			$start = strtotime($startTimeStr);
			
			$arr = array();
			$diff = $end - $start;
			$arr['diff'] = $diff;
			$diff = abs( $end - $start );
			
			$arr['day'] = floor($diff/86400);
			$arr['hour'] = floor($diff%86400/3600);
			$arr['minute'] = floor($diff%86400/60);
			$arr['sencond'] = floor($diff%86400%60);
			$arr['time'] = "";
			if( $arr['hour']<10 ) $arr['time'] .= "0";
			$arr['time'] .= $arr['hour'].":";
			if( $arr['minute']<10 ) $arr['time'] .="0";
			$arr['time'] .= $arr['minute'].":";
			if( $arr['sencond']<10 ) $arr['time'] .= "0";
			$arr['time'] .= $arr['sencond'];
			return $arr;
		}
		//生成当前时间
		function getTimeStr(){
			return date("H:i:s");
		}
		//生成当前日期
		function getDateStr(){
			return date("Y-m-d");
		}
		//生成当前日期时间
		function getDateTimeStr(){
			return date("Y-m-d H:i:s");
		}
		function getDateTimeStamp(){
			return time();
		}
	}

?>
