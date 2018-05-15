<?php
	/*上传文件*/
	class C_File{
		var $FILE = "";
		//初始文件
		function initFile($file){
			if( is_array( $file ) ){
				$this-> FILE = $file;
				return true;
			}
			return false;
		}
		//获取文件名称
		function getName(){
			$arr = array();
			if( is_array($this->FILE) ){
				foreach($this->FILE as $cnt){
					$str = $cnt['name'];
					$tmp = strrchr($str,".");
					$str = rtrim($str,$tmp);
					array_push($arr,$str);
				}
			}
			return $arr;
		}
		//获取文件大小
		function getSize(){
			$arr = array();
			if( is_array($this->FILE) ){
				foreach($this->FILE as $cnt){
					$str = $cnt['size'];
					array_push($arr,$str);
				}
			}
			return $arr;
		}
		//获取后缀名
		function getSuffixName(){
			$arr = array();
			if( is_array($this->FILE) ){
				foreach($this->FILE as $i){
					$str = $i['name'];
					$str = strrchr($str,".");
					$str = trim($str,".");
					array_push($arr,$str);
				}
			}
			return $arr;
		}
		//判断文件类型
		function typeJudge($typeArr){
			if(!is_array($typeArr)) $typeArr = array($typeArr);
			$typeArr = $this->arraytolower($typeArr);
			$suffix = $this->getSuffixName();
			foreach($suffix as $i){
				$str = strtolower($i);
				if( !in_array($str,$typeArr) ){
					return false;
				}
			}
			return true;
		}
		//是否是图片
		function isImage(){
			return $this->typeJudge( array('jpg','jpeg','gif','png','tif') );
		}
		//是否是文档
		function isDoc(){
			return $this->typeJudge( array('doc','docx','wps') );
		}
		//是否是表格
		function isExcel(){
			return $this->typeJudge( array('xls','xlsx','wps') );
		}
		//是否是演示文档
		function isPpt(){
			return $this->typeJudge( array('ppt','pptx','wps') );
		}
		//是否是压缩文件
		function isZipile(){
			return $this->typeJudge( array('rar','zip','cab','arj','lzh','7z','tar','gzip','uue','z') );
		}
		//是否是视频
		function isVideo(){
			return $this->typeJudge( array('avi','rmvb','flv','wmv','asf','rm','divx','mpg','mpeg','mpe','mp4','mkv','vob') );
		}
		//文件移动
		function moveFile($path,$randName=false){
			$num = 0;
			foreach($this->FILE as $cnt){
				if( is_uploaded_file($cnt['tmp_name']) ){
					$name = $cnt['name'];
					if( $randName ) $name = $this->randName($cnt['tmp_name']).strrchr($cnt['name'],".");
					if( move_uploaded_file( $cnt['tmp_name'],"{$path}/".$name) ){
						$num++;
					}
				}
			}
			return $num;
		}
		
		/*辅助函数*/
		function arraytolower($array){
			$arr = array();
			if(!is_array($array)) $array = array($array);
			foreach($array as $i){
				array_push($arr,strtolower($i));
			}
			return $arr;
		}
		function randName($str){
			return md5(uniqid("rand_".$str));
		}
	}
?>
