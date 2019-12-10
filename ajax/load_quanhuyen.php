<?php
	
	session_start();
	error_reporting(0);
	@define ( '_lib' , '../libraries/');
	@define ( '_source' , '../sources/');
    
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
	include_once _source."lang_$lang.php";
	
	$d = new database($config['database']);
	
	$id_list = (int)$_POST['id'];
	$d->reset();
	$d->query("select ten,id from #_place_dist where hienthi=1 and id_list ='".$id_list."' order by id asc");
	$quanhuyen = $d->result_array();
	echo "<option value=''>Quận huyện</option>";
	foreach ($quanhuyen as $key => $value) {
		echo "<option value='".$value['id']."'>".$value['ten']."</option>";
	}
?>