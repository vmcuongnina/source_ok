<?php  if(!defined('_source')) die("Error");
		

		$id_list_tk = (int) $_GET['list'];
		$key = $d->escape_str($_GET['keywords']);
		$key_khong_dau=changeTitle($key);

		$per_page = 1; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_product where type='product' and hienthi=1";
		if(!empty($id_list_tk) && $id_list_tk>0){
			$where.=" and id_list='$id_list_tk'";
		}
		if($key!=''){
			$where.=" and LOWER(CONVERT(ten_$lang USING utf8)) LIKE '%".mb_strtolower($key,'utf-8')."%'";
		}
		$where .= " order by giaban";

		$sql = "select id,ten_$lang as ten,tenkhongdau,photo,giaban,giacu from $where $limit";
		$d->query($sql);
		$product = $d->result_array();
		$title_detail = 'Kết quả tìm kiếm "'.$key.'"';

		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);

		$arr_bread[1]['name'] = $title_detail;
		$arr_bread[1]['link'] = getCurrentPageURL(); 
		$arr_bread[1]['pos'] = 2;
?>