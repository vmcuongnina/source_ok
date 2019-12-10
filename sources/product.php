<?php  if(!defined('_source')) die("Error");

		@$idc =  addslashes($_GET['idc']);
		@$idl =  addslashes($_GET['idl']);
		@$idi =  addslashes($_GET['idi']);
		@$ids =  addslashes($_GET['ids']);
		@$id=  addslashes($_GET['id']);
		#các sản phẩm khác======================

		$arr = explode('?',$_SERVER['REQUEST_URI']);
		parse_str($arr[1], $param);	
		$temp = explode('&page=',$arr[0]);
		$url_cur = $temp[0];
		$paramString = http_build_query($param);
		$link_filter = '';

		$where = " #_product where hienthi=1 and type='".$type_bar."'";
		$where_all = " #_product where hienthi=1 and type='".$type_bar."'";

		
		$txt_orderby = 'stt, ngaytao desc';

		if(!empty($param['sex'])){  // giới tính
			$id_gioitinh = get_id_from_url($param['sex']);
			$where .= " and find_in_set($id_gioitinh, gioitinh) > 0";
		}

		if(!empty($param['price'])){  // mức giá
			$d->reset();
			$sql = "select id,giatu,giaden from table_thuoctinh where tenkhongdau='".$param['price']."' limit 0,1";
			$d->query($sql);
			$filter_gia = $d->fetch_array();
			$where .= " and (giaban>=".$filter_gia['giatu']." and giaban < ".$filter_gia['giaden'].")";
		}

		if(!empty($param['size'])){  // size
			$str = array();
			$arr_url_size = explode(',', $param['size']);
			for($i=0; $i<count($arr_url_size); $i++){
				$id_filter_size = get_id_from_url($arr_url_size[$i]);
				if($id_filter_size>0){
					$str[] = "find_in_set($id_filter_size, arr_id_size) > 0";
				}
			}
			if(count($str)>0){
				$where .= " and (";
				$where .= implode(' and ', $str);
				$where .= ')';
			}
		}

		if(!empty($param['color'])){  // màu sắc
			$str = array();
			$arr_url_color = explode(',', $param['color']);
			for($i=0; $i<count($arr_url_color); $i++){
				$id_filter_color = get_id_from_url($arr_url_color[$i]);
				if($id_filter_color>0){
					$str[] = "find_in_set($id_filter_color, arr_id_color) > 0";
				}
			}
			if(count($str)>0){
				$where .= " and (";
				$where .= implode(' and ', $str);
				$where .= ')';
			}
		}

		if(!empty($param['material'])){  // Chất liệu
			
			$str = array();
			$arr_url_chatlieu = explode(',', $param['material']);
			for($i=0; $i<count($arr_url_chatlieu); $i++){
				$id_filter_cl = get_id_from_url($arr_url_chatlieu[$i]);
				if($id_filter_cl>0){
					$str[] = "find_in_set($id_filter_cl, chatlieu) > 0";
				}
			}
			if(count($str)>0){
				$where .= " and (";
				$where .= implode(' and ', $str);
				$where .= ')';
			}
		}
		
		if(!empty($param['page'])){
			$page = $param['page'];
		}
		
		$per_page = 16; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		

		if($id!=''){

			$d->reset();
			$sql_detail = "select * from #_product where hienthi=1 and type='$type_bar' and id='".$id."'";
			$d->query($sql_detail);
			$row_detail = $d->fetch_array();
			// unset($_SESSION['product_viewed']);
			if(count($_SESSION['product_viewed'])==12){
				unset($_SESSION['product_viewed'][0]); // xóa sp xem đầu tiên
				ksort($_SESSION['product_viewed']); // sắp xếp lại number key của mảng
				if(!in_array($row_detail['id'], $_SESSION['product_viewed'])){
					$_SESSION['product_viewed'][12] = $row_detail['id'];
				}
				
			}else{
				if(!in_array($row_detail['id'], $_SESSION['product_viewed'])){
					$_SESSION['product_viewed'][] = $row_detail['id'];
				}
			}

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau from #_product_cat where hienthi=1 and type='$type_bar' and id='".$row_detail['id_cat']."'";
			$d->query($sql);
			$row_detail_cat = $d->fetch_array();

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau from #_product_list where hienthi=1 and type='$type_bar' and id='".$row_detail['id_list']."'";
			$d->query($sql);
			$row_detail_list = $d->fetch_array();

			
			$sql_lanxem = "UPDATE #_product SET luotxem=luotxem+1  WHERE id ='".$id."'";
			$d->query($sql_lanxem);


			$sql_tenweb = "select ten_$lang from #_setting limit 0,1";
			$d->query($sql_tenweb);
			$tenweb = $d->fetch_array();
			
			$fb_tenweb = $tenweb['ten_'.$lang];
		
			$fb_link_web_full = getCurrentPageURL();
			
			$fb_title =$row_detail['ten_'.$lang];
			$fb_link_full_img=$config_http.$config_url.'/'._upload_product_l.$row_detail['photo'];
			$fb_description=$row_detail['description'];

			$d->reset();
			$sql = "select * from #_product_photo where hienthi=1 and id_product='".$id."' and type='$type_bar' order by stt,id desc";
			$d->query($sql);
			$product_photo = $d->result_array();

			
			$d->reset();
			$sql = "select ten_$lang as ten, name_$lang as name,id,tenkhongdau,photo,giaban,giacu from #_product where hienthi=1 and type='$type_bar' and id<>'".$row_detail['id']."'";
			$sql_price = "select id from #_product where hienthi=1 and type='$type_bar' and id<>'".$row_detail['id']."'";
			if(!empty($row_detail['id_list'])){
				$sql .= " and id_list='".$row_detail['id_list']."'";
			}
			if(!empty($row_detail['id_cat'])){
				$sql .= " and id_cat='".$row_detail['id_cat']."'";
			}
			if(!empty($row_detail['id_item'])){
				$sql .= " and id_item='".$row_detail['id_item']."'";
			}
			// if($row_detail['giaban']>0){ // lấy chênh lệch nhau 50.000
			// 	$gia_begin = $row_detail['giaban']-50000;
			// 	$gia_end = $row_detail['giaban']+50000;
			// 	$sql.=" and (giaban>=$gia_begin and giaban<=$gia_end)";
			// }
			
			$sql.=' order by stt,ngaytao desc limit 0,12';
			$d->query($sql);
			$product = $d->result_array();

			$title_bar .= $row_detail['title'];
			$keywords_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

			$arr_bread = array();
			$k_arr = 1;
			$pos_arr = 2;
			// $arr_bread[$k_arr]['name'] = get_name_by_com($com);
			// $arr_bread[$k_arr]['link'] = $com; 
			// $arr_bread[$k_arr]['pos'] = $pos_arr; 

			// $k_arr++;
			// $pos_arr++;

			if(!empty($row_detail_list)){
				$arr_bread[$k_arr]['name'] = $row_detail_list['ten_'.$lang];
				$arr_bread[$k_arr]['link'] = $row_detail_list['tenkhongdau']; 
				$arr_bread[$k_arr]['pos'] = $pos_arr; 	

				$k_arr++;
				$pos_arr++;			
			}

			if(!empty($row_detail_cat)){
				$arr_bread[$k_arr]['name'] = $row_detail_cat['ten_'.$lang];
				$arr_bread[$k_arr]['link'] = $row_detail_cat['tenkhongdau']; 
				$arr_bread[$k_arr]['pos'] = $pos_arr; 	

				$k_arr++;
				$pos_arr++;			
			}

			$arr_bread[$k_arr]['name'] = $row_detail['ten_'.$lang];
			$arr_bread[$k_arr]['link'] = getCurrentPageURL(); 
			$arr_bread[$k_arr]['pos'] = $pos_arr;


		} elseif($idl!=''){

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_list where hienthi=1 and type='$type_bar' and id='".$idl."'";
			$d->query($sql);
			$row_detail = $d->fetch_array();
			$id_list = $idl;

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau,thumb,photo from #_product_cat where hienthi=1 and type='$type_bar' and id_list='".$row_detail['id']."' order by stt,ngaytao desc";
			$d->query($sql);
			$row_item_tt = $d->result_array();
			
			$where .= " and id_list='$idl'";
			$where_all .= " and id_list='$idl'";

			$where .= ' order by '.$txt_orderby.'';

			$sql = "select ten_$lang as ten, name_$lang as name,id,tenkhongdau,photo,giaban,giacu from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$title_detail = $row_detail['ten_'.$lang];
			$title_bar .= $row_detail['title'];
			$keywords_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

			// $arr_bread[1]['name'] = get_name_by_com($com);
			// $arr_bread[1]['link'] = $com; 
			// $arr_bread[1]['pos'] = 2;

			$arr_bread[1]['name'] = $row_detail['ten_'.$lang];
			$arr_bread[1]['link'] = getCurrentPageURL(); 
			$arr_bread[1]['pos'] = 2;


		} elseif($idc!=''){

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau,id_list,title,keywords,description from #_product_cat where hienthi=1 and type='$type_bar' and id='".$idc."'";
			$d->query($sql);
			$row_detail = $d->fetch_array();
			$id_cat = $row_detail['id'];


			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau from #_product_list where hienthi=1 and type='$type_bar' and id='".$row_detail['id_list']."'";
			$d->query($sql);
			$row_detail_list = $d->fetch_array();
			$id_list = $row_detail_list['id'];
		
			$where .= " and id_cat='$idc'";
			$where_all .= " and id_cat='$idc'";
			$where .= ' order by '.$txt_orderby.'';

			$sql = "select ten_$lang as ten, name_$lang as name,id,tenkhongdau,photo,giaban,giacu from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);


			$title_detail = $row_detail['ten_'.$lang];
			$title_bar .= $row_detail['title'];
			$keywords_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

			$arr_bread = array();
			$k_arr = 1;
			$pos_arr = 2;

			// $arr_bread[1]['name'] = get_name_by_com($com);
			// $arr_bread[1]['link'] = $com; 
			// $arr_bread[1]['pos'] = 2;

			if(!empty($row_detail_list)){
				$arr_bread[$k_arr]['name'] = $row_detail_list['ten_'.$lang];
				$arr_bread[$k_arr]['link'] = $row_detail_list['tenkhongdau']; 
				$arr_bread[$k_arr]['pos'] = $pos_arr; 	

				$k_arr++;
				$pos_arr++;			
			}


			$arr_bread[$k_arr]['name'] = $row_detail['ten_'.$lang];
			$arr_bread[$k_arr]['link'] = getCurrentPageURL(); 
			$arr_bread[$k_arr]['pos'] = $pos_arr;

		} elseif($idi!=''){

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau,id_list,id_cat,title,keywords,description from #_product_item where hienthi=1 and type='$type_bar' and id='".$idi."'";
			$d->query($sql);
			$row_detail = $d->fetch_array();
			$id_item = $idi;

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau from #_product_list where hienthi=1 and type='$type_bar' and id='".$row_detail['id_list']."'";
			$d->query($sql);
			$row_detail_list = $d->fetch_array();
			$id_list = $row_detail_list['id'];

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau from #_product_cat where hienthi=1 and type='$type_bar' and id='".$row_detail['id_cat']."'";
			$d->query($sql);
			$row_detail_cat = $d->fetch_array();
			$id_cat = $row_detail_cat['id'];

			
			$where .= " and id_item='$idi'";
			$where_all .= " and id_item='$idi'";

			$where .= ' order by '.$txt_orderby.'';

			$sql = "select ten_$lang as ten, name_$lang as name,id,tenkhongdau,photo,giaban,giacu from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$title_detail = $row_detail['ten_'.$lang];
			$title_bar .= $row_detail['title'];
			$keywords_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];


			$arr_bread = array();
			$k_arr = 1;
			$pos_arr = 2;

			if(!empty($row_detail_list)){
				$arr_bread[$k_arr]['name'] = $row_detail_list['ten_'.$lang];
				$arr_bread[$k_arr]['link'] = $row_detail_list['tenkhongdau']; 
				$arr_bread[$k_arr]['pos'] = $pos_arr; 	

				$k_arr++;
				$pos_arr++;			
			}

			if(!empty($row_detail_cat)){
				$arr_bread[$k_arr]['name'] = $row_detail_cat['ten_'.$lang];
				$arr_bread[$k_arr]['link'] = $row_detail_list['tenkhongdau'].'/'.$row_detail_cat['tenkhongdau']; 
				$arr_bread[$k_arr]['pos'] = $pos_arr; 	

				$k_arr++;
				$pos_arr++;			
			}

			$arr_bread[$k_arr]['name'] = $row_detail['ten_'.$lang];
			$arr_bread[$k_arr]['link'] = getCurrentPageURL(); 
			$arr_bread[$k_arr]['pos'] = $pos_arr;

		} else {
			
			$where .= ' order by '.$txt_orderby.'';

			$sql = "select ten_$lang as ten, name_$lang as name,id,tenkhongdau,photo,giaban,giacu from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);
		}


		
		// toàn bộ sản phẩm
		$d->reset();
		$sql = "select ten_$lang as ten, name_$lang as name,id,tenkhongdau,photo,giaban,giacu,gioitinh,chatlieu,arr_id_color,arr_id_size from $where_all";
		$d->query($sql);
		$arr_product_all = $d->result_array();

		$arr_filter_price = arr_price_in_list_product($arr_product_all);

		$arr_filter_gioitinh = arr_key_in_list_product($arr_product_all,'gioitinh');
		usort($arr_filter_gioitinh, function($a, $b) { return $a['stt'] - $b['stt']; });

		$arr_filter_size = arr_key_in_list_product($arr_product_all,'arr_id_size');
		usort($arr_filter_size, function($a, $b) { return $a['stt'] - $b['stt']; });

		$arr_filter_color= arr_key_in_list_product($arr_product_all,'arr_id_color');
		usort($arr_filter_color, function($a, $b) { return $a['stt'] - $b['stt']; });

		$arr_filter_chatlieu = arr_key_in_list_product($arr_product_all,'chatlieu');
		usort($arr_filter_chatlieu, function($a, $b) { return $a['stt'] - $b['stt']; });

		// print_r($_SESSION['product_viewed']);
?>