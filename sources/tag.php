<?php  if(!defined('_source')) die("Error");
		

		$key = $d->escape_str(trim($_GET['key']));

		$d->reset();
		$sql = "select * from #_tags where tenkhongdau='".$key."'";
		$d->query($sql);
		$row_detail = $d->fetch_array();

		$title_bar .= $row_detail['title'];
		$keywords_bar .= $row_detail['keywords'];
		$description_bar .= $row_detail['description'];
		$fb_description=$row_detail['description'];

		$per_page = 20; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;

		$where = " #_product where hienthi=1 and type='$type_bar'";
		if(!empty($key)){
			$where.= " and find_in_set('".$row_detail['id']."', tags) > 0";
		}
		$where.=' order by stt,ngaytao desc';

		$sql = "select ten_$lang as ten,id,thumb,photo,giacu,giaban,tenkhongdau,mota_$lang from $where $limit";
		$d->query($sql);
		$product = $d->result_array();

		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);

		$title_detail = 'Tag: '.$row_detail['ten_'.$lang];

		$arr_bread[1]['name'] = $title_detail;
		$arr_bread[1]['link'] = getCurrentPageURL(); 
		$arr_bread[1]['pos'] = 2;
?>