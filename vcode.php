<?php
@session_start();

function randCode($_width,$_height,$_num,$_flag = true){
	$_num = 4;
	$_SESSION['vcode'] = substr(randname(),0,4);
	$_img = imagecreatetruecolor($_width,$_height);
	header('Content-Type:image/png');
	ob_clean();
	$_white = imagecolorallocate($_img,255,255,255);
	$_black = imagecolorallocate($_img,0,0,0);
	imagefill($_img,0,0,$_white);
	if($_flag) imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
	$lineNum = 5;
	for($i = 0;$i < $lineNum;$i ++ ){
		$_rand_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rand_color);
	}
	for($i = 0;$i < 30;$i ++){
		$_rand_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
		imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rand_color);
	}
	for($i = 0;$i < $_num ;$i ++){
		$_rand_color = imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200));
		imagestring($_img,58,$i*$_width/$_num+mt_rand(0,10),mt_rand(1,$_height/2),$_SESSION['vcode'][$i],$_rand_color);
	}
	imagepng($_img);
	imagedestroy($_img);
}
function randname(){
	 return md5(uniqid(rand()));
}
randCode(120,56,4);
?>
