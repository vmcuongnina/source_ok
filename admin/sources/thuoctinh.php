<?php	if(!defined('_source')) die("Error");
switch($act){

	case "man":
		get_items();
		$template = "thuoctinh/items";
		break;
	case "add":		
		$template = "thuoctinh/item_add";
		break;
	case "edit":		
		get_item();
		$template = "thuoctinh/item_add";
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
	
	
	if($_REQUEST['noibat']!='')
	{
	$id_up = $_REQUEST['noibat'];
	$sql_sp = "SELECT id,noibat FROM table_gia where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$time=time();
	$hienthi=$cats[0]['noibat'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_gia SET noibat =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_gia SET noibat =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	#----------------------------------------------------------------------------------------
	if($_REQUEST['hienthi']!='')
	{
	$id_up = $_REQUEST['hienthi'];
	$sql_sp = "SELECT id,hienthi FROM table_gia where id='".$id_up."' ";
	$d->query($sql_sp);
	$cats= $d->result_array();
	$hienthi=$cats[0]['hienthi'];
	if($hienthi==0)
	{
	$sqlUPDATE_ORDER = "UPDATE table_gia SET hienthi =1 WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}
	else
	{
	$sqlUPDATE_ORDER = "UPDATE table_gia SET hienthi =0  WHERE  id = ".$id_up."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}
	#-------------------------------------------------------------------------------
	
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_thuoctinh where 1=1 and type='".$_GET['type']."'";
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if(!empty($_REQUEST['id_list_pro'])){
		$id_list_pro = (int)$_REQUEST['id_list_pro'];
		$where.=" and id_list_pro='$id_list_pro'";
		$link_add .= "&id_list_pro=".$id_list_pro;
	}
	$where .=" order by stt,id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=thuoctinh&act=man&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);		
	
}

function get_item(){
	global $d, $item,$ds_tags;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=thuoctinh&act=man&type=".$_GET['type']);	
	$sql = "select * from #_thuoctinh where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=thuoctinh&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	
}

function save_item(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=thuoctinh&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	

			$d->setTable('thuoctinh');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);	
	
			}
		}
		$data['id_list_pro'] = (int)$_POST['id_list_pro'];

		$data['ten_vi'] = $_POST['ten_vi'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['ten_en'] = $_POST['ten_en'];
		$data['ten_kr'] = $d->escape_str($_POST['ten_kr']);
		$data['giatu'] = str_replace(',','',$_POST['giatu']);
		$data['giaden'] = str_replace(',','',$_POST['giaden']);
		$data['giatri'] = str_replace(',','',$_POST['giatri']);
		$data['color'] = $_POST['color'];
		$data['stt'] = $_POST['stt'];

		$data['mota_vi'] = $d->escape_str($_POST['mota_vi']);
		$data['mota_en'] = $d->escape_str($_POST['mota_en']);
		$data['mota_kr'] = $d->escape_str($_POST['mota_kr']);
		$data['noidung_vi'] = $d->escape_str($_POST['noidung_vi']);
		$data['noidung_en'] = $d->escape_str($_POST['noidung_en']);
		$data['noidung_kr'] = $d->escape_str($_POST['noidung_kr']);

		$data['attr1'] = $_POST['attr1'];
		$data['attr2'] = $_POST['attr2'];
		$data['attr3'] = $_POST['attr3'];
		$data['attr4'] = $_POST['attr4'];
		$data['attr5'] = $_POST['attr5'];

		$data['ten_kr'] = $d->escape_str($_POST['ten_kr']);
		$data['mota_kr'] = $d->escape_str($_POST['mota_kr']);
		$data['noidung_kr'] = $d->escape_str($_POST['noidung_kr']);

		$data['title'] = $d->escape_str($_POST['title']);
		$data['keywords'] = $d->escape_str($_POST['keywords']);
		$data['description'] = $d->escape_str($_POST['description']);
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['type'] = $_GET['type'];
		$data['ngaysua'] = time();
		$d->setTable('thuoctinh');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=thuoctinh&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=thuoctinh&act=man&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;			
		}		
		$data['id_list_pro'] = (int)$_POST['id_list_pro'];
		$data['ten_vi'] = $_POST['ten_vi'];
		$data['ten_en'] = $_POST['ten_en'];
		$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		$data['giatu'] = str_replace(',','',$_POST['giatu']);
		$data['giaden'] = str_replace(',','',$_POST['giaden']);
		$data['giatri'] = str_replace(',','',$_POST['giatri']);
		$data['stt'] = $_POST['stt'];
		$data['color'] = $_POST['color'];
		$data['mota_vi'] = $d->escape_str($_POST['mota_vi']);
		$data['mota_en'] = $d->escape_str($_POST['mota_en']);
		$data['noidung_vi'] = $d->escape_str($_POST['noidung_vi']);
		$data['noidung_en'] = $d->escape_str($_POST['noidung_en']);

		$data['ten_kr'] = $d->escape_str($_POST['ten_kr']);
		$data['mota_kr'] = $d->escape_str($_POST['mota_kr']);
		$data['noidung_kr'] = $d->escape_str($_POST['noidung_kr']);

		$data['attr1'] = $_POST['attr1'];
		$data['attr2'] = $_POST['attr2'];
		$data['attr3'] = $_POST['attr3'];
		$data['attr4'] = $_POST['attr4'];
		$data['attr5'] = $_POST['attr5'];

		$data['title'] = $d->escape_str($_POST['title']);
		$data['keywords'] = $d->escape_str($_POST['keywords']);
		$data['description'] = $d->escape_str($_POST['description']);

		$data['type'] = $_GET['type'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('thuoctinh');
		if($d->insert($data))
		{			
			redirect("index.php?com=thuoctinh&act=man&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=thuoctinh&act=man&type=".$_GET['type']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$sql = "delete from #_thuoctinh where id='".$id."'";
			$d->query($sql);
		if($d->query($sql))
			redirect("index.php?com=thuoctinh&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=thuoctinh&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$sql = "delete from #_thuoctinh where id='".$id."'";
			$d->query($sql);
		}
		redirect("index.php?com=thuoctinh&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=thuoctinh&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}


}


?>