<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man":
		get_items();
		$template = "download/items";
		break;
	case "add":
		$template = "download/item_add";
		break;
	case "edit":
		get_item();
		$template = "download/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
		
	default:
		$template = "index";
}


function get_items(){
	global $d, $items, $paging,$page;
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){	
				$d->reset();
				$d->query("select photo,thumb,file from #_download where id='".$id_array[$i]."'");	
				if($d->num_rows()==1){
					$download = $d->fetch_array();
					delete_file(_upload_hinhanh.$download['photo']);
					delete_file(_upload_hinhanh.$download['thumb']);
					delete_file(_upload_file.$download['file']);

					$sql = "delete from table_download where id = ".$id_array[$i]."";
					$d->query($sql) or die("Not query sqlUPDATE_ORDER");
				}					
			}
			redirect("index.php?com=download&act=man&type=".$_GET['type']);			
		}				
	}
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_download ";
	$where .= " where type='".$_GET['type']."' ";

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

	$url = "index.php?com=download&act=man&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);		
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=download&act=man&type=".$_GET['type']);
	
	$sql = "select * from #_download where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=download&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);
	$file_download=images_name($_FILES['file_download']['name']);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=download&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	$data=process_quote($_POST['data']);
	if($id){ // cap nhat
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _img_type, _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);
			$d->reset();		
			$d->setTable('download');
			$d->setWhere('id', $id);
			$d->select("photo,thumb");
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);	
				delete_file(_upload_hinhanh.$row['thumb']);				
			}
		}

		if($file_d = upload_image("file_download", 'pdf|doc|docx', _upload_file,$file_download)){
			$data['file'] = $file_d;	
			$d->reset();
			$d->setTable('download');
			$d->setWhere('id', $id);
			$d->select("file");
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_file.$row['file']);				
			}
		}

		
		$data['id_list'] = (int)$_POST['id_list'];
		$data['url'] = $_POST['url'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['num'];
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('download');
		$d->setWhere('id', $id);
		if($d->update($data))
			header("Location:index.php?com=download&act=man&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=download&act=man&type=".$_GET['type']);
	}else{ // them moi
		if($photo = upload_image("file", _img_type, _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);	
		}
		if($file_d = upload_image("file_download", 'pdf|doc|docx', _upload_file,$file_download)){
			$data['file'] = $file_d;
		}
		$data['id_list'] = (int)$_POST['id_list'];
		$data['url'] = $_POST['url'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['num'];
		$data['hienthi'] = isset($_POST['active']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('download');
		if($d->insert($data))
			header("Location:index.php?com=download&act=man&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=download&act=man&type=".$_GET['type']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		
		$d->reset();
		$sql = "select id,photo,thumb,file from #_download where id='".$id."'";
		$d->query($sql);
		
		if($d->num_rows()==1){
			$download = $d->fetch_array();
			delete_file(_upload_hinhanh.$download['photo']);
			delete_file(_upload_hinhanh.$download['thumb']);
			delete_file(_upload_file.$download['file']);
		}
		$sql = "delete from #_download where id='".$id."'";
		if($d->query($sql))
			header("Location:index.php?com=download&act=man&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=download&act=man&type=".$_GET['type']);
	}else transfer("Không nhận được dữ liệu", "index.php?com=download&act=man&type=".$_GET['type']);
}
#--------------------------------------------------------------------------------------------- photo
?>