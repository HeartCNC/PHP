<?php
    $test = new Page();
    $arr = $test->pagedate(1,100,10);
    foreach($arr as $i)
        echo "{$i} ";
		
/* 对象名：Page
 * 成员变量：
 *     @ $now 
 */
    class Page{
		var $now = 1;    //当前页面
		var $all = 0;    //数据总数
		var $each = 20;   // 
		var $allpage;
		var $disnum = 5;
		function pagedate($now,$all,$each,$ellipsis=true){
			$this->allpage = ceil($all/$each);
			$arr = array();
			if($ellipsis == true){
				if($this->allpage > $this->disnum){
					$d = $now - 2;
					$start = 1;
					for($i=$start;$i<$this->disnum+$d-1;$i++){
						array_push($arr,$i);
					}
					array_push($arr,"...");
					array_push($arr,$this->allpage);
				}
				else{
					for($i=1;$i<=$this->disnum;$i++){
						array_push($arr,$i);
					}
				}
			}
			else{
				for($i=1;$i<=$this->allpage;$i++){
					array_push($arr,$i);
				}
			}
			return $arr;
		}
		function setDisnum($newDisnum){
			$newDisnum = intval($newDisnum);
			if( $newDisnum > 0 ){
				$this->$disnum = $newDisnum;
				return true;
			}
			return false;
		}
	}
?>
<?php
/* 对象名：Page
 * 成员函数：
 *   @ pagedate
 *   @param $now 当前页码
 *   @param $all 数据总数
 *   @param $each 每页显示数
 *   @return $arr 页标数组
 */
    class C_Page{
		var $now = 1;    //当前页面
		var $all = 0;    //数据总数
		var $each = 20;  //每页数据数
		var $allpage;    //总页数
		var $disnum = 5; //页标显示个数
		
		function pagedate($now,$all,$each){
			$this->allpage = ceil($all/$each);
			$arr = array();
			for($i=1;$i<=$this->allpage;$i++){
				array_push($arr,$i);
			}
			return $arr;
		}
	}
?>
