<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man_photo":
		get_photos();
		$template = "photo/photos";
		break;
	case "add_photo":		
		$template = "photo/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "photo/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
		break;			
	default:
		$template = "index";
}

function get_photos(){
	global $d, $items,$paging,$page;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_photo SET hienthi =1 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_photo SET hienthi =0 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				
				$sql = "select id,photo_vi,photo_en,thumb_vi,thumb_en from #_photo where id= ".$id_array[$i]."";
				$d->query($sql);
				if($d->num_rows()>0){
					while($row = $d->fetch_array()){
						delete_file(_upload_hinhanh.$row['photo_vi']);
						delete_file(_upload_hinhanh.$row['photo_en']);
						delete_file(_upload_hinhanh.$row['thumb_vi']);
						delete_file(_upload_hinhanh.$row['thumb_en']);
					}
				}
				$sql = "delete from table_photo where id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);			
		}				
	}
		
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_photo ";
	$where .= " where id <> 0";		
	
	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}
	$where.=" order by stt,id desc ";				
	
	$sql = "select * from $where $limit";		
	$d->query($sql);
	$items = $d->result_array();
	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
}

function get_photo(){
	global $d, $item, $list_cat;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$d->setTable('photo');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$item = $d->fetch_array();	
}

function save_photo(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,15);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data=process_quote($_POST['data']);
	if($id){
		foreach ($config['lang'] as $key => $value) {
			if($photo = upload_image("file_".$key, 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name.$key)){
				$data['photo_'.$key] = $photo;
				$data['thumb_'.$key] = create_thumb($data['photo_'.$key], _width_thumb, _height_thumb , _upload_hinhanh,$file_name.$key,_style_thumb);	
				$d->setTable('photo');
				$d->setWhere('id', $id);
				$d->select("photo_$key,thumb_$key");
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo_'.$key]);
					delete_file(_upload_hinhanh.$row['thumb_'.$key]);
				}
			}
		}
		$data['stt'] = $_POST['stt'];
		$data['id_list'] = (int)$_POST['id_list'];
		$data['link'] = $_POST['link'];
		$data['type'] = $_POST['type'];	
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$d->reset();
		$d->setTable('photo');
		$d->setWhere('id', $id);
		if(!$d->update($data)) 
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
			
	}else{ 		
		$upload_image=false;
		foreach ($config['lang'] as $key => $value) {
			if($data['photo_'.$key] = upload_image("file_".$key, 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name.$key)){		
				$data['thumb_'.$key] = create_thumb($data['photo_'.$key], _width_thumb, _height_thumb , _upload_hinhanh,$file_name.$key.'thumb',_style_thumb);
				$upload_image=true;	
				$data['ten_'.$key] = $_POST['ten_'.$key];	
				$data['mota_'.$key] = $_POST['mota_'.$key];
			}
		}
		
		$data['stt'] = $_POST['stt'];
		$data['id_list'] = (int)$_POST['id_list'];
		$data['link'] = $_POST['link'];	
		$data['type'] = $_POST['type'];									
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;																	
		$d->setTable('photo');
		if(!$d->insert($data)) 
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		
		redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	}
}

function delete_photo(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		$row = $d->fetch_array();
		delete_file(_upload_hinhanh.$row['photo_vi']);
		delete_file(_upload_hinhanh.$row['thumb_vi']);
		delete_file(_upload_hinhanh.$row['photo_en']);
		delete_file(_upload_hinhanh.$row['thumb_en']);
		if($d->delete())
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	}else transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
}
?>	