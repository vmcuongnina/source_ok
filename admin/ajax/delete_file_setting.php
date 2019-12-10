<?php
		session_start();
	@define ( '_lib' , '../../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";

	$d = new database($config['database']);
	
	$id=$_POST['id'];

	$d->reset();
	$sql = "select file_up from #_setting";
	$d->query($sql);
	$row = $d->fetch_array();

	if(!empty($row)){
		delete_file('../'._upload_file.$row['file_up']);
		$sql = "update #_setting set file_up='' where 1=1";
		$d->query($sql);
	}
	
?>
