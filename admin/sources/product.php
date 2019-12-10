<?php	if(!defined('_source')) die("Error");
switch($act){

	case "man_list":
		get_lists();
		$template = "product/list/items";
		break;
	case "add_list":		
		$template = "product/list/item_add";
		break;
	case "edit_list":		
		get_list();
		$template = "product/list/item_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;	
	#===================================================
	case "man_cat":
		get_cats();
		$template = "product/cat/items";
		break;
	case "add_cat":		
		$template = "product/cat/item_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "product/cat/item_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;	
	#===================================================
	case "man_item":
		get_items();
		$template = "product/item/items";
		break;
	case "add_item":		
		$template = "product/item/item_add";
		break;
	case "edit_item":		
		get_item();
		$template = "product/item/item_add";
		break;
	case "save_item":
		save_item();
		break;
	case "delete_item":
		delete_item();
		break;
	#===================================================
	case "man_sub":
		get_subs();
		$template = "product/sub/items";
		break;
	case "add_sub":		
		$template = "product/sub/item_add";
		break;
	case "edit_sub":		
		get_sub();
		$template = "product/sub/item_add";
		break;
	case "save_sub":
		save_sub();
		break;
	case "delete_sub":
		delete_sub();
		break;	
	#===================================================
	case "man":
		get_mans();
		$template = "product/man/items";
		break;
	case "add":		
		$template = "product/man/item_add";
		break;
	case "edit":		
		get_man();
		$template = "product/man/item_add";
		break;
	case "save":
		save_man();
		break;
		
	case "delete":
		delete_man();
		break;	
	
	case "man_imgcolor":
		get_imgcolors();
		$template = "product/img_color/items";
		break;
	case "add_imgcolor":
		$template = "product/img_color/item_add";
		break;
	case "save_imgcolor":
		save_imgcolor();
		break;
	case "edit_imgcolor":
		get_imgcolor();
		$template = "product/img_color/item_add";
		break;
	case "delete_imgcolor":
		delete_imgcolor();
		break;
	default:
		$template = "index";
}

#====================================

function get_mans(){
	global $d, $items, $paging,$page;
	
	
	$per_page = 15; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_product ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list = ".$_GET['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat = ".$_GET['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	if($_REQUEST['id_item']!='')
	{
		$where.=" and id_item = ".$_GET['id_item'];
		$link_add .= "&id_item=".$_GET['id_item'];
	}
	if($_REQUEST['id_sub']!='')
	{
		$where.=" and id_sub = ".$_GET['id_sub'];
		$link_add .= "&id_sub=".$_GET['id_sub'];
	}
	if($_REQUEST['soluong']!='')
	{	
		if($_GET['soluong']==1){
			$where.=" and soluong=0 ";
		} else{
			$where.=" and soluong > 0 and soluong < ".$_GET['soluong'];
		}
		$link_add .= "&soluong=".$_GET['soluong'];
	}

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by stt,id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,noibat,id_item,photo,id_sub,banchay,soluong,new,km from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);		
	
}

function get_man(){
	global $d, $item,$ds_tags,$ds_photo;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);	
	$sql = "select * from #_product where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();	

	$sql = "select * from #_product_photo where id_product='".$id."' and type='".$_GET['type']."' order by stt,id desc ";
	$d->query($sql);
	$ds_photo = $d->result_array();	
}

function save_man(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data=process_quote($_POST['data']);
	if($id){
		
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;
			//dongdauanh($photo,_upload_product);	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
			$d->setTable('product');
			$d->setWhere('id', $id);
			$d->select("photo,thumb");
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);	
				delete_file(_upload_product.$row['thumb']);				
			}
		}

	    $data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_sub'] = (int)$_POST['id_sub'];
		$data['id_loaihinh'] = (int)$_POST['id_loaihinh'];
		$data['id_xuatxu'] = (int)$_POST['id_xuatxu'];

		$data['rate'] = $_POST['rate'];
		
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		
		$data['giaban'] = str_replace(',','',$_POST['giaban']);
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['soluong'] = str_replace(',','',$_POST['soluong']);
		$data['masp'] = $_POST['masp'];
		
		if(!empty($_POST['tags'])){
			$data['tags'] = implode(',',$_POST['tags']);
		}else{
			$data['tags'] = '';
		}
		

		$data['arr_id_color'] = $_POST['color'];
	
		// if(!empty($_POST['size']) && count($_POST['size'])>0){
		// 	$data['arr_id_size'] = implode(',',$_POST['size']);
		// }else{
		// 	$data['arr_id_size'] = '';
		// }

		// xóa size và cập nhật size mới.
		// $arr_size = array();
		// $d->reset();
		// $d->query("DELETE FROM table_size WHERE id_product='$id'");
		// $data_size = $_POST['data_size'];
		// if(!empty($data_size)){
		// 	foreach($data_size as $s){
		// 		$d->reset();
		// 		$sql_in = "INSERT INTO table_size(id_product,stt,size,giacu,giaban) VALUES ('".$id."','".$s[0]."','".$s[1]."','".str_replace(',','',$s[2])."','".str_replace(',','',$s[3])."')";
		// 		$d->query($sql_in);
		// 		$arr_size[] = $s[1];
		// 	}
		// 	$data['arr_id_size'] = implode(',',$arr_size);
		// }else{
		// 	$data['arr_id_size'] = '';
		// }

		// $d->reset();
		// $sql = "SELECT giaban,giacu FROM table_size WHERE id_product='$id' order by giaban limit 0,1";
		// $d->query($sql);
		// $record = $d->fetch_array();

		// if(!empty($record) && $record['giaban']>0){
		// 	$d->reset();
		// 	$sql = "UPDATE table_product SET giacu='".$record['giacu']."',giaban='".$record['giaban']."' WHERE id='".$id."'";
		// 	$d->query($sql);
		// }else{
		// 	$d->reset();
		// 	$sql = "UPDATE table_product SET giacu='0',giaban='0' WHERE id='".$id."'";
		// 	$d->query($sql);
		// }
		
		if(!empty($_POST['gioitinh']) && count($_POST['gioitinh'])>0){
			$data['gioitinh'] = implode(',',$_POST['gioitinh']);
		}else{
			$data['gioitinh'] = '';
		}

		if(!empty($_POST['chatlieu']) && count($_POST['chatlieu'])>0){
			$data['chatlieu'] = implode(',',$_POST['chatlieu']);
		}else{
			$data['chatlieu'] = '';
		}
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $d->escape_str($_POST['description']);
		
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

	
		$data['ngaysua'] = time();
		$d->setTable('product');
		$d->setWhere('id', $id);
		if($d->update($data)){

			if (isset($_FILES['files'])) {
	            for($i=0;$i<count($_FILES['files']['name']);$i++){
	            	if($_FILES['files']['name'][$i]!=''){

						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
					    $file_name = images_name($_FILES['files']['name'][$i]);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name);
						$data1['photo'] = $photo;
						//dongdauanh($data1['photo'],_upload_product);
						$data1['thumb'] = create_thumb($data1['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_product'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('product_photo');
						$d->insert($data1);

					}
				}
	        }

			redirect($_SESSION['links_re']);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;
			//dongdauanh($data['photo'],_upload_product);		
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
		}		
		
	    $data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_sub'] = (int)$_POST['id_sub'];
		$data['id_loaihinh'] = (int)$_POST['id_loaihinh'];

		
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		
		
		$data['rate'] = $_POST['rate'];
		
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['giaban'] = str_replace(',','',$_POST['giaban']);

		$data['soluong'] = str_replace(',','',$_POST['soluong']);
		
		$data['masp'] = $_POST['masp'];

		$data['arr_id_color'] = $_POST['color'];
		if(!empty($_POST['size']) && count($_POST['size'])>0){
			$data['arr_id_size'] = implode(',',$_POST['size']);
		}else{
			$data['arr_id_size'] = '';
		}

		if(!empty($_POST['gioitinh']) && count($_POST['gioitinh'])>0){
			$data['gioitinh'] = implode(',',$_POST['gioitinh']);
		}else{
			$data['gioitinh'] = '';
		}

		if(!empty($_POST['chatlieu']) && count($_POST['chatlieu'])>0){
			$data['chatlieu'] = implode(',',$_POST['chatlieu']);
		}else{
			$data['chatlieu'] = '';
		}

		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		
		$data['stt'] = $_POST['stt'];

		if(!empty($_POST['tags'])){
			$data['tags'] = implode(',',$_POST['tags']);
		}else{
			$data['tags'] = '';
		}
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('product');
		if($d->insert($data))
		{	

			$id = $d->insert_id;

			// xóa size và cập nhật size mới.
			// $arr_size = array();
			// $d->reset();
			// $d->query("DELETE FROM table_size WHERE id_product='$id'");
			// $data_size = $_POST['data_size'];
			// if(!empty($data_size)){
			// 	foreach($data_size as $s){
			// 		$d->reset();
			// 		$sql_in = "INSERT INTO table_size(id_product,stt,size,giacu,giaban) VALUES ('".$id."','".$s[0]."','".$s[1]."','".str_replace(',','',$s[2])."','".str_replace(',','',$s[3])."')";
			// 		$d->query($sql_in);
			// 		$arr_size[] = $s[1];
			// 	}
			// 	$data['arr_id_size'] = implode(',',$arr_size);
			// }else{
			// 	$data['arr_id_size'] = '';
			// }

			// $d->reset();
			// $sql = "SELECT giaban,giacu FROM table_size WHERE id_product='$id' order by giaban limit 0,1";
			// $d->query($sql);
			// $record = $d->fetch_array();

			// if(!empty($record) && $record['giaban']>0){
			// 	$d->reset();
			// 	$sql = "UPDATE table_product SET giacu='".$record['giacu']."',giaban='".$record['giaban']."' WHERE id='".$id."'";
			// 	$d->query($sql);
			// }else{
			// 	$d->reset();
			// 	$sql = "UPDATE table_product SET giacu='0',giaban='0' WHERE id='".$id."'";
			// 	$d->query($sql);
			// }
			
			// // update size
			// $d->reset();
			// $sql = "UPDATE table_product SET arr_id_size='".$data['arr_id_size']."' WHERE id='$id'";
			// $d->query($sql);

			
			if (isset($_FILES['files'])) {
	            for($i=0;$i<count($_FILES['files']['name']);$i++){
	            	if($_FILES['files']['name'][$i]!=''){

						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
					    $file_name = images_name($_FILES['files']['name'][$i]);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name);
						$data1['photo'] = $photo;
						//dongdauanh($data1['photo'],_upload_product);
						$data1['thumb'] = create_thumb($data1['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_product'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('product_photo');
						$d->insert($data1);

					}
				}
	        }

			redirect($_SESSION['links_re']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}

function delete_man(){
	global $d;
	

	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);


		$d->reset();
		$sql = "select id,photo,thumb from #_product_photo where id_product='".$id."'";
		$d->query($sql);
		$photo_lq = $d->result_array();
		if(count($photo_lq)>0){
			for($i=0;$i<count($photo_lq);$i++){
				delete_file(_upload_product.$photo_lq[$i]['photo']);
				delete_file(_upload_product.$photo_lq[$i]['thumb']);
			}
		}
		$sql = "delete from #_product_photo where id_product='".$id."'";
		$d->query($sql);

		$d->reset();
		$sql = "select id,photo,thumb from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){

			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}

			// xóa size
			$d->reset();
			$sql = "delete from #_size where id_product='".$id."'";
			$d->query($sql);


			$sql = "delete from #_product where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){

		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	


			$d->reset();
			$sql = "select id,photo,thumb from #_product_photo where id_product='".$id."'";
			$d->query($sql);
			$photo_lq = $d->result_array();
			if(count($photo_lq)>0){
				for($j=0;$j<count($photo_lq);$j++){
					delete_file(_upload_product.$photo_lq[$j]['photo']);
					delete_file(_upload_product.$photo_lq[$j]['thumb']);
				}
			}
			$sql = "delete from #_product_photo where id_product='".$id."'";
			$d->query($sql);

			$d->reset();
			$sql = "select id,photo,thumb from #_product where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}

				// xóa size
				$d->reset();
				$sql = "delete from #_size where id_product='".$id."'";
				$d->query($sql);
				
				$sql = "delete from #_product where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}


}


#=================List===================

function get_lists(){
	global $d, $items, $paging,$page;


	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	
	$where = " #_product_list ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by stt,id desc";

	$sql = "select ten_vi,id,stt,hienthi,noibat from $where $limit";
	$d->query($sql);
	$items = $d->result_array();
    
    $url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
}

function get_list(){
	global $d, $item,$array_xuatxu;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	
	$sql = "select * from #_product_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();

	$array_xuatxu = explode(',',$item['xuatxu']);
}

function save_list(){
	global $d;
	
	$file_name=images_name($_FILES['file']['name']);
	$file_quangcao=images_name($_FILES['file']['quangcao']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data=process_quote($_POST['data']);
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select("photo,thumb");
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
			}
		}
		if($quangcao = upload_image("quangcao", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_quangcao)){
			$data['quangcao'] = $quangcao;	
			$data['quangcao_thumb'] = create_thumb($data['quangcao'], 895, 260, _upload_product,$file_quangcao,1);		
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['quangcao']);	
				delete_file(_upload_product.$row['quangcao_thumb']);				
			}
		}

		
		$data['links'] = $_POST['links'];
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		$data['xuatxu'] = implode(',',$_POST['xuatxu']);
		$d->setTable('product_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		if($photo = upload_image("file", _img_type, _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
		}
		if($quangcao = upload_image("quangcao", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_quangcao)){
			$data['quangcao'] = $quangcao;	
			$data['quangcao_thumb'] = create_thumb($data['quangcao'], 895, 260, _upload_product,$file_quangcao,1);		
		}
		
		$data['links'] = $_POST['links'];
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$data['type'] = $_GET['type'];
		$data['xuatxu'] = implode(',',$_POST['xuatxu']);
		$d->setTable('product_list');
		if($d->insert($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}

function delete_list(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
				delete_file(_upload_product.$row['quangcao']);
				delete_file(_upload_product.$row['quangcao_thumb']);
			}
			$sql = "delete from #_product_list where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
					delete_file(_upload_product.$row['quangcao']);
					delete_file(_upload_product.$row['quangcao_thumb']);
				}
				$sql = "delete from #_product_list where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}

#=================cat===================

function get_cats(){
	global $d, $items, $paging,$page;

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	
	$where = " #_product_cat ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}

	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,noibat from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
}

function get_cat(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	
	$sql = "select * from #_product_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();
}

function save_cat(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data=process_quote($_POST['data']);
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
			$d->setTable('product_cat');
			$d->setWhere('id', $id);
			$d->select("photo,thumb");
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
			}
		}
		$data['id_list'] = $_POST['id_list'];
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
		}
		$data['id_list'] = $_POST['id_list'];
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_cat');
		if($d->insert($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}

function delete_cat(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_cat where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_cat where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_cat where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}
#=================Item===================

function get_items(){
	global $d, $items, $paging,$page;

	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_product_item ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat=".$_REQUEST['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}

	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
}

function get_item(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$_GET['type']);
	
	$sql = "select * from #_product_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data=process_quote($_POST['data']);
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
			$d->setTable('product_item');
			$d->setWhere('id', $id);
			$d->select("photo,thumb");
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
			}
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_item');
		if($d->insert($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_item where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_item where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_item where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}
#=================Sub===================

function get_subs(){
	global $d, $items, $paging,$page;


	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_product_sub ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat=".$_REQUEST['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	if($_REQUEST['id_item']!='')
	{
		$where.=" and id_item=".$_REQUEST['id_item'];
		$link_add .= "&id_item=".$_GET['id_item'];
	}
	$where .=" order by id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat,id_item from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
}

function get_sub(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	
	$sql = "select * from #_product_sub where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();
}

function save_sub(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);
	if(empty($_POST)) transfer("Không nhận được dữ liệu",$_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data=process_quote($_POST['data']);
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
			$d->setTable('product_sub');
			$d->setWhere('id', $id);
			$d->select("photo,thumb");
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);	
				delete_file(_upload_product.$row['thumb']);				
			}
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_item'] = $_POST['id_item'];
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_sub');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['id_item'] = $_POST['id_item'];
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('product_sub');
		if($d->insert($data))
			redirect($_SESSION['links_re']);
		else
			transfer("Lưu dữ liệu bị lỗi",$_SESSION['links_re']);
	}
}

function delete_sub(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_sub where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_sub where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_sub where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_sub where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}
#====================================

function get_imgcolors(){
	global $d, $items, $paging,$page;

	

	$per_page = 15; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;

	$where = " #_product_image_color ";
	$where .= " where type='".$_GET['type']."' and id_product='".$_GET['id_product']."'";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);	
}
function get_imgcolor(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);	
	$sql = "select * from #_product_image_color where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();	

}
function save_imgcolor(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id){

		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
			$d->setTable('product_image_color');
			$d->setWhere('id', $id);
			$d->select("photo,thumb");
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);	
				delete_file(_upload_product.$row['thumb']);				
			}
		}
		$data['colorId'] = (int)$_POST['colorId'];
		$data['sizeId'] = (int)$_POST['sizeId'];
		$data['color'] = $_POST['color'];
		$data['giaban'] = str_replace(',','',$_POST['giaban']);
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		$d->setTable('product_image_color');
		$d->setWhere('id',$id);
		if($d->update($data)){
			redirect($_SESSION['links_re']);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
		
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_product,$file_name,_style_thumb);	
		}	
		$data['colorId'] = (int)$_POST['colorId'];
		$data['sizeId'] = (int)$_POST['sizeId'];
		$data['id_product'] = $_GET['id_product'];
		$data['color'] = $_POST['color'];
		$data['giaban'] = str_replace(',','',$_POST['giaban']);
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['stt'] = $_POST['stt'];
		$data['type'] = $_GET['type'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('product_image_color');
		if($d->insert($data)){

			redirect($_SESSION['links_re']);

		}
		else
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
	}
}
function delete_imgcolor(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_image_color where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_image_color where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect($_SESSION['links_re']);
		else
			transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
	} elseif (isset($_GET['idcolor'])==true){
		$listid = explode(",",$_GET['idcolor']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_image_color where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_image_color where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}
?>