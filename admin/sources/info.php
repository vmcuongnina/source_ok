<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		get_info();
		$template = "info/item_add";
		break;
	case "save":
		save_info();
		break;		
	default:
		$template = "index";
}


function get_info(){
	global $d, $item;
	$type = $_GET['type'];

	$sql = "select * from #_info where type='$type' limit 0,1";	
	$d->query($sql);
	$item = $d->fetch_array();
	
}

function save_info(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);

	$d->reset();
	$sql = "select * from #_info where type='".$_GET['type']."' ";	
	$d->query($sql);
	$row_item = $d->result_array();

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=info&act=capnhat&type=".$_GET['type']);
	$type = $_GET['type'];
	$data=process_quote($_POST['data']);
	if(count($row_item )>0){

		
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);	
			$d->setTable('info');
			$d->setWhere('type', $type);
			$d->select("photo,thumb");
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);	
				delete_file(_upload_hinhanh.$row['thumb']);				
			}
		}

	
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaysua'] = time();
		$d->setTable('info');
		$d->setWhere('type', $type);
		if($d->update($data))
			redirect("index.php?com=info&act=capnhat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=info&act=capnhat&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], _width_thumb, _height_thumb, _upload_hinhanh,$file_name,_style_thumb);
		}		

		
		$data['tenkhongdau'] = changeTitle($data['ten_vi']);
		$data['type'] = $_GET['type'];

		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
				
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

		$data['ngaytao'] = time();
		$d->setTable('info');
		if($d->insert($data))
		{			
			redirect("index.php?com=info&act=capnhat&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=info&act=capnhat&type=".$_GET['type']);
	}
}

?>