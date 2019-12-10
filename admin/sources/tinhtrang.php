<?php	if(!defined('_source')) die("Error");
switch($act){

	case "man":
		get_items();
		$template = "tinhtrang/items";
		break;
	case "add":		
		$template = "tinhtrang/item_add";
		break;
	case "edit":		
		get_item();
		$template = "tinhtrang/item_add";
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
	

#====================================

function get_items(){
	global $d, $items, $paging,$page;
	
	
	
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_tinhtrang ";
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by id desc";

	$sql = "select trangthai,id,stt,hienthi from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=tinhtrang&act=man&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);		
	
}

function get_item(){
	global $d, $item,$ds_tags;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=tinhtrang&act=man&type=".$_GET['type']);	
	$sql = "select * from #_tinhtrang where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tinhtrang&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	
}

function save_item(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tinhtrang&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_tinhtrang,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 295, 195, _upload_tinhtrang,$file_name,1);		
			$d->setTable('tinhtrang');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_tinhtrang.$row['photo']);	
				delete_file(_upload_tinhtrang.$row['thumb']);				
			}
		}


		$data['trangthai'] = $_POST['trangthai'];
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaytao'] = time();
		$d->setTable('tinhtrang');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=tinhtrang&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tinhtrang&act=man&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_tinhtrang,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 295, 195, _upload_tinhtrang,$file_name,1);		
		}		

		$data['trangthai'] = $_POST['trangthai'];
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaytao'] = time();
		$d->setTable('tinhtrang');
		if($d->insert($data))
		{			
			redirect("index.php?com=tinhtrang&act=man&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=tinhtrang&act=man&type=".$_GET['type']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id from #_tinhtrang where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			
			$sql = "delete from #_tinhtrang where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=tinhtrang&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tinhtrang&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id from #_tinhtrang where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				
				$sql = "delete from #_tinhtrang where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=tinhtrang&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=tinhtrang&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}


}


?>