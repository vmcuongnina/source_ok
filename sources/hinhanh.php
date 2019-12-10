<?php  if(!defined('_source')) die("Error");

		
	$sql="select photo_vi,ten_$lang as ten from";
	$per_page = 16; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$where = " #_photo where hienthi=1 and type='".$type_bar."'";
	$sql.=$where." order by stt, id desc $limit";
	$d->query($sql);
	$tintuc = $d->result_array();
	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);

	
?>