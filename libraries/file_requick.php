<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;
	

	$data = array(
		array("tbl"=>"info","field"=>"id","source"=>"about","com"=>"gioi-thieu","type"=>"gioithieu"),
		array("tbl"=>"product_list","field"=>"idl","source"=>"product","com"=>"san-pham","type"=>"product"),
		array("tbl"=>"product_cat","field"=>"idc","source"=>"product","com"=>"san-pham","type"=>"product"),
		array("tbl"=>"product","field"=>"id","source"=>"product","com"=>"san-pham","type"=>"product"),
		array("tbl"=>"baiviet_list","field"=>"idl","source"=>"news","com"=>"cam-nang-suc-khoe","type"=>"camnang"),
		array("tbl"=>"baiviet","field"=>"id","source"=>"news","com"=>"cam-nang-suc-khoe","type"=>"camnang"),
		// array("tbl"=>"baiviet","field"=>"id","source"=>"news","com"=>"tin-tuc","type"=>"tintuc"),
		// array("tbl"=>"album","field"=>"id","source"=>"album","com"=>"bo-suu-tap","type"=>"album"),
		// array("tbl"=>"baiviet","field"=>"id","source"=>"news","com"=>"chuong-trinh-khuyen-mai","type"=>"khuyenmai"),
		array("tbl"=>"baiviet","field"=>"id","source"=>"news","com"=>"chinh-sach","type"=>"chinhsach"),
	);
    if($com){
		foreach($data as $k=>$v){
			if(isset($com) && $v['tbl']!='info'){
				$d->query("select id from #_".$v['tbl']." where hienthi=1 and tenkhongdau='".$com."' and type='".$v['type']."'");
				if($d->num_rows()>=1){
					$row = $d->fetch_array();
					$_GET[$v['field']] = $row['id'];
					$com = $v['com'];	
					break;
				}
			}
		}
    }

    
	switch($com){
		// case 'ngon-ngu':
		// 	$_SESSION['lang']=$_GET['lang'];
		// 	header('Location: ' . $_SERVER['HTTP_REFERER']);
		// break;
		// case 'dang-ky':
		// 	$source = "register";
		// 	$template = "register";
		// 	break;
		// case 'resetpass':
		// 	$source ="resetpass";
		// 	break;
		// case 'quen-mat-khau':
		// 	$source = "rematkhau";
		// 	$template="rematkhau";
		// 	break;
		// case 'activated':
		// 	$source = "activemail";
		// 	$template = "activemail";
		// 	break;
		// case 'doi-mat-khau':
		// 	$source = "doimatkhau";
		// 	$template = "doimatkhau";
		// 	break;
		// case 'tai-khoan':
		// 	$source = "taikhoan";
		// 	$template = "taikhoan";
		// 	break;
		// case 'dang-nhap':
		// 	if($_SESSION['loginuser']){
		//         transfer("Bạn vui lòng đăng xuất trước khi đăng nhập tài khoản khác", "http://".$config_url."/");
		//     }
		// 	$source = "login";
		// 	$template="login";
		// 	break;
		// case 'logout':
		// 	unset($_SESSION['loginuser']);
		// 	header("Location:http://".$config_url);
		// 	break;
		
		case 'gio-hang':
			$source = "giohang";
			$template = "giohang";
			$title_detail = "Giỏ hàng";
		break;

		case 'thanh-toan':
			$source = "thanhtoan";
			$template = "thanhtoan";
			$title_detail = "Thanh toán";
		break;
		// case 'chung-nhan':
		// 	$source = "hinhanh";
		// 	$template = "hinhanh";
		// 	$title_detail = "Chứng nhận";
		// 	$type_bar = 'gcn';
		// break;
		// case 'video':
		// 	$source = "video";
		// 	$template = "video";
		// 	$title_detail = 'Video';
		// 	$type_bar = 'video';
		// break;
		case 'gioi-thieu':
			$source = "about";
			$template = "about";
			$title_detail = "Giới thiệu";
			$type_bar = 'gioithieu';
			$og_type = 'article';
		break;
		// case 'bo-suu-tap':
		// 	$source = "album";
		// 	$template = isset($_GET['id']) ? "album_detail" : "album";
		// 	$type_bar = 'album';
		// 	$title_detail = 'Bộ sưu tập';
		// break;
		case 'cam-nang-suc-khoe':
			$source = "dichvu";
			$template = isset($_GET['id']) ? "dichvu_detail" : "dichvu";
			$type_bar = 'camnang';
			$title_detail = "Cảm nang sức khỏe";
			$og_type = 'article';
		break;
		case 'chinh-sach':
			$source = "dichvu";
			$template = isset($_GET['id']) ? "dichvu_detail" : "dichvu";
			$type_bar = 'chinhsach';
			$title_detail = "Chính sách";
			$og_type = 'article';
		break;
		case 'san-pham':
			$source = "product";
			$template =isset($_GET['id']) ? "product_detail" : "product";
			$title_detail = _sanpham;
			$type_bar = 'product';	
			$og_type = 'product';
		break;
		case 'tag':
			$source = "tag";
			$template = "product";
			$type_bar = 'product';
			$og_type = 'product';
		break;
						
		case 'lien-he':
			$source = "contact";
			$template = "contact";
			$title_detail = _lienhe;
		break;
		case 'tim-kiem':
			$source = "search";
			$template = "product";
			$og_type = 'product';
		break;
		case '': 
			$source = 'index';
			$template = 'index'; 
			break;
		default:
			header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
	        include_once '404.php';
	        exit();
	}
	
	if($source!="") include _source.$source.".php";
?>