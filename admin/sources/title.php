<?php	if(!defined('_source')) die("Error");
switch($act){

	
	case "man":
		get_mans();
		$template = "title/items";
		break;
	case "add":		
		$template = "title/item_add";
		break;
	case "edit":
		get_man();
		$template = "title/item_add";
		break;
	case "save":
		save_man();
		break;
	case "delete":
		delete_man();
		break;	
	#============================================================

	default:
		$template = "index";
}

#====================================
function get_mans(){
	global $d, $items, $paging,$page;
	
	
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_title ";
	$where .= " where id<>0";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and com_page='".$keyword."'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=title&act=man".$link_add;
	$paging = pagination($where,$per_page,$page,$url);	
}
function get_man(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer($_SESSION['links_re']);
	
	$sql = "select * from #_title where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", $_SESSION['links_re']);
	$item = $d->fetch_array();
}
function save_man(){
	global $d,$config;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);
		$data['title'] = $d->escape_str($_POST['title']);
		$data['keywords'] = $d->escape_str($_POST['keywords']);
		$data['description'] = $d->escape_str($_POST['description']);
		$data['ngaysua'] = time();
		$d->reset();
		$d->setTable('title');
		$d->setWhere('id', $id);
		if($d->update($data)){
			redirect($_SESSION['links_re']);
		}else{
			transfer("Cập nhật dữ liệu bị lỗi", $_SESSION['links_re']);
		}
	}else{
		$data['title'] = $d->escape_str($_POST['title']);
		$data['keywords'] = $d->escape_str($_POST['keywords']);
		$data['description'] = $d->escape_str($_POST['description']);
		$data['com_page'] = $d->escape_str($_POST['com_page']);
		$data['ngaytao'] = time();
		$d->reset();
		$d->setTable('title');
		if($d->insert($data)){
			redirect($_SESSION['links_re']);
		}else{
			transfer("Lưu dữ liệu bị lỗi", $_SESSION['links_re']);
		}
	}
}
function delete_man(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id from #_title where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "delete from #_title where id='".$id."'";
			if($d->query($sql))
				redirect($_SESSION['links_re']);
			else
				transfer("Xóa dữ liệu bị lỗi", $_SESSION['links_re']);
		}
		
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id from #_title where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				$sql = "delete from #_title where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect($_SESSION['links_re']);
	} else {
		transfer("Không nhận được dữ liệu", $_SESSION['links_re']);
	}
}
?>