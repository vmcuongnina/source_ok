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
	$q=(int)$_POST['sl'];
	$size = (int)$_POST['size'];
	$color = (int)$_POST['color'];

    addtocart($pid,$q,$size,$color);
	echo count_total_item_cart();
	die();
?>