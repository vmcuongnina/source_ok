<?php  if(!defined('_source')) die("Error");
		

		$per_page = 20; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_product where type='product' and hienthi=1 and giacu>0";
		$where .= " order by giaban";

		$sql = "select id,ten_$lang,mota_$lang,tenkhongdau,photo,thumb,giaban,giacu from $where $limit";
		$d->query($sql);
		$product = $d->result_array();
		
		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);
?>