<?php  if(!defined('_source')) die("Error");

	
	$id =  addslashes($_GET['id']);
	if ($id!='') {
		$sql = "select * from #_album where hienthi=1 and id='".$id."' and type='$type_bar'";
	$d->query($sql);
	$album_detail = $d->fetch_array();

	$title_detail = $album_detail['ten_'.$lang];

	$title_bar .= $album_detail['title'];
	$keywords_bar .= $album_detail['keywords'];
	$description_bar .= $album_detail['description'];


	$fb_tenweb = $row_setting['ten_'.$lang];
	$fb_link_web_full = getCurrentPageURL();
	$fb_title =$album_detail['ten_'.$lang];
	$fb_link_full_img=$http.$config_url.'/'._upload_album_l.$album_detail['photo'];
	$fb_description=$album_detail['description'];

	
	$d->reset();
	$sql_khac = "select * from #_album_photo where hienthi=1 and id_album ='".$id."' and type='$type_bar' order by id desc";
	$d->query($sql_khac);
	$album_images = $d->result_array();
	} else {
		$sql_tintuc = "select * from #_album where hienthi=1 order by id desc";
		$d->query($sql_tintuc);
		$album = $d->result_array();
		
		
		$title_bar .= $row_meta['title'];
		$keywords_bar .= $row_meta['keywords'];
		$description_bar .= $row_meta['description'];
	}
?>