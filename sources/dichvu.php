<?php  if(!defined('_source')) die("Error");

		@$idc =  addslashes($_GET['idc']);
		@$idl =  addslashes($_GET['idl']);
		@$idi =  addslashes($_GET['idi']);
		@$ids =  addslashes($_GET['ids']);
		@$id=  addslashes($_GET['id']);

		
		$keywords_bar = $row_setting['keywords'];
		$description_bar = $row_setting['description'];

		if($id!=''){
			$sql = "select * from #_baiviet where hienthi=1 and id='".$id."'";
			$d->query($sql);
			
			$row_detail = $d->fetch_array();
			$title_other= 'Bài viết liên quan';

			$fb_tenweb = $row_setting['ten_'.$lang];
			$fb_link_web_full = getCurrentPageURL();
			$fb_title =$row_detail['ten_'.$lang];
			$fb_link_full_img=$http.$config_url.'/'._upload_baiviet_l.$row_detail['photo'];
			$fb_description=$row_detail['description'];

			$title_detail = $row_detail['ten_'.$lang];
			if($row_detail['title']!=''){
				$title_bar = $row_detail['title'];
			}else{
				$title_bar = $row_detail['ten_'.$lang];
			}
			$keyword_bar = $row_detail['keywords'];
			$description_bar = $row_detail['description'];
			
			#các tin cu hon
			$sql_khac = "select ten_$lang,ngaytao,id,tenkhongdau,photo,mota_$lang from #_baiviet where hienthi=1 and id !='".$row_detail['id']."' and type='".$type_bar."'";
			if(!empty($row_detail['id_list'])){
				$sql_khac.=" and id_list='".$row_detail['id_list']."'";
			}
			$sql_khac.=" order by stt,ngaytao desc limit 0,10";
			$d->query($sql_khac);
			$tintuc = $d->result_array();

			$arr_bread = array();
			$k_arr = 1;
			$pos_arr = 2;

			// if($com!='chinh-sach'){
				$arr_bread[$k_arr]['name'] = get_name_by_com($com);
				$arr_bread[$k_arr]['link'] = $com; 
				$arr_bread[$k_arr]['pos'] = $pos_arr; 

				$k_arr++;
				$pos_arr++;
			//}


			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau,id_list from #_baiviet_cat where hienthi=1 and type='$type_bar' and id='".$row_detail['id_cat']."'";
			$d->query($sql);
			$row_detail_cat = $d->fetch_array();

			$d->reset();
			$sql = "select id,ten_$lang,tenkhongdau from #_baiviet_list where id='".$row_detail['id_list']."'";
			$d->query($sql);
			$row_detail_list = $d->fetch_array();

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

		}elseif($idl!=''){ 
			$d->reset();
			$sql_cat="select * from #_baiviet_list where id='".$idl."' and type='".$type_bar."'";
			$d->query($sql_cat);
			
			$row_detail=$d->fetch_array();
			$where = " #_baiviet where hienthi=1 and type='".$type_bar."' and id_list='".$row_detail['id']."'";
			$sql="select * from";
			$per_page = 12; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			$sql.=$where." order by stt,ngaytao desc $limit";
			$d->query($sql);
			$tintuc = $d->result_array();
			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);
			$title_detail = $row_detail['ten_'.$lang];
			if($row_detail['title']!=''){
				$title_bar = $row_detail['title'];
			}else{
				$title_bar = $row_detail['ten_'.$lang];
			}
			$keywords_bar = $row_detail['keywords'];
			$description_bar = $row_detail['description'];

			$arr_bread[1]['name'] = get_name_by_com($com);
			$arr_bread[1]['link'] = $com; 
			$arr_bread[1]['pos'] = 2;

			$arr_bread[2]['name'] = $row_detail['ten_'.$lang];
			$arr_bread[2]['link'] = getCurrentPageURL(); 
			$arr_bread[2]['pos'] = 3;
			
		}elseif($idc!=''){
			$d->reset();
			$sql_cat="select * from #_baiviet_cat where id='".$idc."' and type='".$type_bar."'";
			$d->query($sql_cat);
			$row_detail=$d->fetch_array();
			$where = " #_baiviet where hienthi=1 and type='".$type_bar."' and id_cat='".$row_detail['id']."'";
			$sql="select * from";
			$per_page = 12; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			$sql.=$where." order by stt,ngaytao desc $limit";
			$d->query($sql);
			$tintuc = $d->result_array();
			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);
			$title_detail = $row_detail['ten_'.$lang];
			if($row_detail['title']!=''){
				$title_bar = $row_detail['title'];
			}else{
				$title_bar = $row_detail['ten_'.$lang];
			}
			$keywords_bar = $row_detail['keywords'];
			$description_bar = $row_detail['description'];

			$arr_bread[1]['name'] = get_name_by_com($com);
			$arr_bread[1]['link'] = $com; 
			$arr_bread[1]['pos'] = 2;

			$arr_bread[2]['name'] = $row_detail['ten_'.$lang];
			$arr_bread[2]['link'] = getCurrentPageURL(); 
			$arr_bread[2]['pos'] = 3;

		}elseif($idi){
			$d->reset();
			$sql_cat="select * from #_baiviet_item where id='".$idi."' and type='".$type_bar."'";
			$d->query($sql_cat);
			$row_detail=$d->fetch_array();
			$where = " #_baiviet where hienthi=1 and type='".$type_bar."' and id_item='".$row_detail['id']."'";
			$sql="select * from";
			$per_page = 9; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			$sql.=$where." order by stt,ngaytao desc $limit";
			$d->query($sql);
			$tintuc = $d->result_array();
			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);
			$title_detail = $row_detail['ten_'.$lang];
			if($row_detail['title']!=''){
				$title_bar = $row_detail['title'];
			}else{
				$title_bar = $row_detail['ten_'.$lang];
			}
			$keywords_bar = $row_detail['keywords'];
			$description_bar = $row_detail['description'];
		}elseif($ids){
			$d->reset();
			$sql_cat="select * from #_baiviet_sub where id='".$ids."' and type='".$type_bar."'";
			$d->query($sql_cat);
			$row_detail=$d->fetch_array();
			$where = " #_baiviet where hienthi=1 and type='".$type_bar."' and id_sub='".$row_detail['id']."'";
			$sql="select * from";
			$per_page = 12; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			$sql.=$where." order by stt,ngaytao desc $limit";
			$d->query($sql);
			$tintuc = $d->result_array();
			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);
			$title_detail = $row_detail['ten_'.$lang];
			if($row_detail['title']!=''){
				$title_bar = $row_detail['title'];
			}else{
				$title_bar = $row_detail['ten_'.$lang];
			}
			$keywords_bar = $row_detail['keywords'];
			$description_bar = $row_detail['description'];
		}else{

			$sql="select id,ten_$lang,mota_$lang,tenkhongdau,photo,thumb from";
			$per_page = 12; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			$where = " #_baiviet where hienthi=1 and type='".$type_bar."'";
			if(isset($config_nb)){
				$where.=" and noibat=$config_nb";
			}
			$sql.=$where." order by stt,ngaytao desc $limit";
			$d->query($sql);
			$tintuc = $d->result_array();
			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$arr_bread[1]['name'] = $title_detail;
			$arr_bread[1]['link'] = getCurrentPageURL(); 
			$arr_bread[1]['pos'] = 2;

			
		}
	
?>