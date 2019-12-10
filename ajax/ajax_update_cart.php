<?php
	session_start();
	error_reporting(0);

	if(!isset($_SESSION['lang'])||$_SESSION['lang']==''){
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

	@$quantity = (int)$_POST['quantity'];
	@$id_product = $d->escape_str($_POST['id_product']);
	

	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		$md5=$_SESSION['cart'][$i]['md5'];
		if($md5==$id_product){
			$pid = $_SESSION['cart'][$i]['pid'];
			$size_pro=$_SESSION['cart'][$i]['size'];
			$_SESSION['cart'][$i]['qty']=$quantity;
			$row_price = get_price_by_size($pid,$size_pro);

			$arr['total_this'] = number_format($quantity*$row_price['giaban'],0,',','.').'đ';
		}
	}
	$arr['total'] = count_total_item_cart();
	$arr['total_all']=number_format(get_order_total(),0,',','.').'đ';
	echo json_encode($arr);
?>