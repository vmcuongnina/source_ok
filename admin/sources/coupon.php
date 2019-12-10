<?php	if(!defined('_source')) die("Error");
switch($act)
{
	case "man":
		get_items();
		$template = "coupon/man/items";
		break;
	case "add":
		$template = "coupon/man/item_add";
		break;
	case "edit":
		get_item();
		$template = "coupon/man/item_add";
		break;
	case "sendcode":
		get_thanhvien();
		get_item();
		$template = "coupon/man/item_send";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	case "send":
		send();
		break;
	default:
		$template = "index";
}


function get_items()
{
	global $d, $items, $paging;

	$sql = "select * from #_coupon order by stt,id desc";
	$d->query($sql);
	$items = $d->result_array();

}
function get_thanhvien(){
	global $d,$thanhvien;
	$d->reset();
	$d->query("select ten,id from #_thanhvien where active=1 order by id desc");
	$thanhvien = $d->result_array();
}
function get_item()
{
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
	
	$sql = "select * from #_coupon where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=coupon&act=man");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id){

		$id =  themdau($_POST['id']);
		$data['ma'] = $_POST['ma'];
		$data['phantram'] = (int)$_POST['phantram'];		
		$data['loai'] = (int)$_POST['loai'];
		$data['solan'] = (int)$_POST['solan'];
		$data['ngaybatdau'] = strtotime($_POST['ngaybatdau']);
		$data['ngayketthuc'] = strtotime($_POST['ngayketthuc']);
		$data['tinhtrang'] = (int)$_POST['tinhtrang'];
		$data['stt'] = 1;
		
		$d->setTable('coupon');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=coupon&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=coupon&act=man");
	}
	else{ 
		$data['phantram'] = (int)$_POST['phantram'];		
		$data['loai'] = (int)$_POST['loai'];
		$data['ngaybatdau'] = strtotime($_POST['ngaybatdau']);
		$data['ngayketthuc'] = strtotime($_POST['ngayketthuc']);
		$data['ma'] = $_POST['ma'];
		$data['solan'] = (int)$_POST['solan'];
		$data['stt'] = 1;
		$data['tinhtrang'] = 0;
		$d->setTable('coupon');
		if($d->insert($data)){
			redirect("index.php?com=coupon&act=man");
		}else{
			transfer("Hệ thống lỗi", "index.php?com=coupon&act=man");
		}
	}
}

function delete_item()
{
	global $d;
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);

		$d->reset();
		$d->query("delete from #_historical_discount where id_code='".$id."'");

		$sql = "delete from #_coupon where id='".$id."'";
		if($d->query($sql))
			header("Location:index.php?com=coupon&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=coupon&act=man");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id from #_coupon where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				$d->reset();
				$d->query("delete from #_historical_discount where id_code='".$id."'");

				$sql = "delete from #_coupon where id='".$id."'";
				$d->query($sql);
			}
			
		} redirect("index.php?com=coupon&act=man&curPage=".@$_REQUEST['curPage']."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
}
function send(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$thanhvien = $_POST['thanhvien'];
		foreach ($thanhvien as $key => $value) {
			$data['id_code'] = $id;
			$data['ma_code'] = $_POST['macode'];
			$data['id_user'] = $value;
			$d->setTable("historical_discount");
			$d->insert($data);
		}
		transfer("Gửi mã thành công", "index.php?com=coupon&act=man");
	}
}
?>