<?php
	session_start();
	error_reporting(0);

	if(!isset($_SESSION['lang']))
	{
	$_SESSION['lang']='vi';
	}
	$lang=$_SESSION['lang'];
	
	@define ( '_lib' , '../libraries/');
    
	include_once _lib."config.php";
	include_once _lib."constant.php";;
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
    
	$d = new database($config['database']);
	
	$pid = (int)$_POST['id_pro'];
	$size = (int)$_POST['size'];
	$arr = array();
	$row_price = get_price_by_size($pid,$size);
	
	if($row_price['giaban']>0){
		$arr['giaban'] = number_format($row_price['giaban'],0,',','.').'đ';
	}else{
		$arr['giaban'] = 'Liên hệ';
	}
	
	if($row_price['giacu']>0){
		$arr['giacu'] = number_format($row_price['giacu'],0,',','.').'đ';
		$arr['off'] = get_sale($row_price['giacu'],$row_price['giaban'],1);
	}else{
		$arr['giacu'] = '';
		$arr['off'] = '';
	}

    echo json_encode($arr);
	die();
?>