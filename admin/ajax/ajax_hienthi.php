<?php 
session_start();
	@define ( '_lib' , '../../libraries/');
	include_once _lib."config.php";
	include_once _lib.'functions.php';
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	check_role_admin($_SESSION['login']['role']);
	if(isset($_POST["id"])){
		$sql = "update ".$_POST["bang"]." SET ".$_POST["type"]."=".$_POST["value"]." WHERE  id = ".$_POST["id"]."";
		$d->reset();
		$data = $d->query($sql);
	}
?>