<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){	

	case "man":
		get_items();
		$template = "thanhvien/items";
		break;
	case "add":
		$template = "thanhvien/item_add";
		break;
	case "edit":
		get_item();
		$template = "thanhvien/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	case "delete_img":
		delete_photo();
		break;	
	
	default:
		$template = "index";
}

//////////////////
function get_items(){
	global $d, $items,$paging,$page;
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);
		if($multi=='show'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_thanhvien SET active =1 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=thanhvien&act=man");			
		}
		
		if($multi=='hide'){
			for($i=0;$i<$count;$i++){
				$sql = "UPDATE table_thanhvien SET active =0 WHERE  id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");				
			}
			redirect("index.php?com=thanhvien&act=man");			
		}
		
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql = "delete from table_thanhvien where id = ".$id_array[$i]."";
				$d->query($sql) or die("Not query sqlUPDATE_ORDER");			
			}
			redirect("index.php?com=thanhvien&act=man");			
		}
		
		
	}
	
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_thanhvien ";
	$where .= " where id <> 0";	
	
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" where username LIKE '%$keyword%'";
	}
	
	$where.=" order by id desc ";				
	
	$sql = "select * from $where $limit";		
	$d->query($sql);
	$items = $d->result_array();
	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);
	
	
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");
	
	$sql = "select * from #_thanhvien where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=thanhvien&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,15);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){ // cap nhat
		$id =  themdau($_POST['id']);
		$sql = "select * from #_thanhvien where id='$id'";
		$d->query($sql);		
		
		if($photo = upload_image("img", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_images,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('thanhvien');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_images.$row['photo']);
			}
		}

		
		$sql = "select * from #_thanhvien where id!='".$id."' and email='".$_POST['email']."'";
		$d->query($sql);
		if($d->num_rows()>0) transfer("Email này đã có người sử dụng<br/>Xin chọn email khác.", "index.php?com=thanhvien&act=edit&id=".$id);
		
		
		/*$data['username'] = $_POST['username'];*/
		if($_POST['password']!="")
			$data['password'] = md5($_POST['password']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];

		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = $_POST['diachi'];

		//Lưu ngày sinh
		$ngaysinh = $_POST['ngaysinh'];
		$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
		if (count($Ngay_arr)==3) {
			$ngay = $Ngay_arr[0]; //17
			$thang = $Ngay_arr[1]; //11
			$nam = $Ngay_arr[2]; //2010
			if (checkdate($thang,$ngay,$nam)==false){ } else $ngaysinh=$nam."-".$thang."-".$ngay;
		}	
		$ngaysinh = strtotime($ngaysinh);
		$data['ngaysinh']=$ngaysinh;
		
		$d->reset();
		$d->setTable('thanhvien');
		$d->setWhere('id', $id);		
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=thanhvien&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=thanhvien&act=man");
	
	}else{ // them moi
		
		$data['photo'] = upload_image("img", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_images,$file_name);
		
		$sql = "select * from #_thanhvien where email='".$_POST['email']."'";
		$d->query($sql);
		if($d->num_rows()>0) transfer('Email này đã có người sử dụng<br/>Xin chọn email khác', 'index.php?com=thanhvien&act=add');
		
		
		if($_POST['password']=="") transfer("Chưa nhập mật khẩu", "index.php?com=thanhvien&act=add");
		
/*		$data['username'] = $_POST['username'];*/
		$data['password'] = md5($_POST['password']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['sex'] = $_POST['sex'];
		$data['diachi'] = $_POST['diachi'];

		//Lưu ngày sinh
		$ngaysinh = $_POST['ngaysinh'];
		$Ngay_arr = explode("/",$ngaysinh); // array(17,11,2010)
		if (count($Ngay_arr)==3) {
			$ngay = $Ngay_arr[0]; //17
			$thang = $Ngay_arr[1]; //11
			$nam = $Ngay_arr[2]; //2010
			if (checkdate($thang,$ngay,$nam)==false){ } else $ngaysinh=$nam."-".$thang."-".$ngay;
		}	
		$ngaysinh = strtotime($ngaysinh);
		$data['ngaysinh']=$ngaysinh;
		
		$data['randomkey'] = ChuoiNgauNhien(32);
		$d->setTable('thanhvien');
		if($d->insert($data))
			transfer("Dữ liệu đã được lưu", "index.php?com=thanhvien&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=thanhvien&act=man");
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$sql = "select * from #_thanhvien where id='$id'";
		$d->query($sql);		
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['id'] == 1) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=thanhvien&act=man");
		}		
		// xoa item
		$sql = "delete from #_thanhvien where id='".$id."'";
		if($d->query($sql))
			transfer("Xóa thành viên thành công", "index.php?com=thanhvien&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=thanhvien&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");
}
function delete_photo(){
	global $d;		
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id, photo from #_thanhvien where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_images.$row['photo']);	
			}
		$sql = "UPDATE #_thanhvien SET photo ='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=thanhvien&act=edit&id=".$id);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=thanhvien&act=edit&id=".$id);
	}else transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=edit&id=".$id);
}

?>