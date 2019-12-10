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
	$sql = "select file from #_baiviet where id='".$id."'";
	$d->query($sql);
	$row = $d->fetch_array();

	if(!empty($row)){
		delete_file('../'._upload_file.$row['file']);
		$sql = "update #_baiviet set file='' where id='".$id."'";
		$d->query($sql);
	}
	
?>
