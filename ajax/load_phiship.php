<?php  
	session_start();
	error_reporting(0);
	@define ( '_lib' , '../libraries/');
	@define ( '_source' , '../sources/');
    
	include_once _lib."config.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
	
	$d = new database($config['database']);

	$id = (int)$_POST['id'];

	$d->reset();
	$d->query("select phiship from #_place_city where id='".$id."'");
	$row = $d->fetch_array();

	$phiship = $row['phiship'];
	$tongtien = get_order_total() + $phiship;

	$result['phiship'] = number_format($phiship,0,',','.')." vnđ";
	$result['tongtien'] = number_format($tongtien,0,',','.')." vnđ";

	echo json_encode($result);
?>