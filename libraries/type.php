<?php
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";	
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$act = explode('_',$act);
	if(count($act>1)){
		$act = $act[1];
	} else {
		$act = $act[0];
	}
	switch($type){
		//-------------product------------------
		case 'product':
			switch($act){
				case 'list':
					$title_main = "Danh mục cấp 1";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					$config_noibat= "true";
					$config_slider="false";
					@define ( _width_thumb , 444 );
					@define ( _height_thumb ,490 );
					@define ( _style_thumb , 2 );
					$ratio_ = 1;
					break;
				case 'cat':
					$title_main = "Danh mục cấp 2";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					$config_noibat = "true";
					@define ( _width_thumb , 555 );
					@define ( _height_thumb , 232 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				case 'item':
					$title_main = "Danh mục cấp 3";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					@define ( _width_thumb , 555 );
					@define ( _height_thumb , 232 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;

				case 'sub':
					$title_main = "Danh mục cấp 4";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					@define ( _width_thumb , 555 );
					@define ( _height_thumb , 232 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				
				default:
					$title_main = "Sản Phẩm";
					$config_images = "true";
					$config_mota= "true";
					$config_imgcolor = "false";
					$config_banchay = "false";
					$config_moi = "false";
					$config_khuyenmai = "false";
					$config_tags = "false";
					$config_list = "true";
					$config_cat = "true";
					$config_item = "false";
					$config_sub = "false";
					@define ( _width_thumb , 268 );
					@define ( _height_thumb , 268 );
					@define ( _style_thumb , 1 );
					$ratio_ = 2;
					break;
				}
				@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			break;
		case 'alt':
			switch($act){
				case 'list':
					$title_main = "Quản lý tỉnh thành";
					$config_images = "false";
					$config_phiship = "true";
					$config_mota= "false";
					$config_noidung= "false";
					$config_noibat= "false";
					@define ( _width_thumb , 40 );
					@define ( _height_thumb , 37 );
					@define ( _style_thumb , 1 );
					$ratio_ = 2;
					break;
				case 'cat':
					$title_main = "Quản lý quận huyện";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					$config_noibat = "false";
					@define ( _width_thumb , 555 );
					@define ( _height_thumb , 232 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				case 'item':
					$title_main = "Quản lý phường xã";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					@define ( _width_thumb , 555 );
					@define ( _height_thumb , 232 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				default:
					$title_main = "Quản lý đường";
					$config_images = "true";
					$config_mota= "false";
					$config_list = "true";
					$config_cat = "false";
					$config_item = "false";
					$config_sub = "false";
					@define ( _width_thumb , 290 );
					@define ( _height_thumb , 290 );
					@define ( _style_thumb , 1 );
					$ratio_ = 3;
					break;
				}
				@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			break;
		
		case 'tintuc':
			$title_main = "Tin tức";
			$config_images = "true";
			$config_mota= "true";
			$config_noidung= "true";
			$config_noibat = "true";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			@define ( _width_thumb , 290 );
			@define ( _height_thumb , 290 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
		break;

		case 'khuyenmai':
			$title_main = 'Chương trình khuyến mãi';
			$config_file = 'false';
			$config_images = "false";
			$config_mota= "false";
			$config_noidung= "true";
			$config_noibat = "false";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_noseo = 'false';
			@define ( _width_thumb , 280 );
			@define ( _height_thumb , 220 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;


		

		case 'camnang':
			switch($act){
				case 'list':
					$title_main = "Danh mục cấp 1";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					$config_noibat= "false";
					$config_slider="false";
					@define ( _width_thumb , 280 );
					@define ( _height_thumb ,234 );
					@define ( _style_thumb , 1 );
					$ratio_ = 2;
					break;
				case 'cat':
					$title_main = "Danh mục cấp 2";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					$config_noibat = "false";
					@define ( _width_thumb , 555 );
					@define ( _height_thumb , 232 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				case 'item':
					$title_main = "Danh mục cấp 3";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					@define ( _width_thumb , 555 );
					@define ( _height_thumb , 232 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;

				case 'sub':
					$title_main = "Danh mục cấp 4";
					$config_images = "false";
					$config_mota= "false";
					$config_noidung= "false";
					@define ( _width_thumb , 555 );
					@define ( _height_thumb , 232 );
					@define ( _style_thumb , 1 );
					$ratio_ = 1;
					break;
				
				default:
					$title_main = "Cẩm nang sức khỏe";
					$config_images = "true";
					$config_mota= "true";
					$config_file = 'false';
					$config_noidung= "true";
					$config_noibat = "true";
					$config_list = "true";
					$config_cat = "false";
					$config_item = "false";
					$config_sub = "false";
					@define ( _width_thumb , 250 );
					@define ( _height_thumb , 200 );
					@define ( _style_thumb , 1 );
					$ratio_ = 2;
				}
				@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			break;

			
		case 'visao':
			$title_main = "Vì sao chọn chúng tôi";
			$config_images = "true";
			$config_mota= "true";
			$config_noidung= "false";
			$config_noibat = "false";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			$config_noseo = 'true';
			@define ( _width_thumb , 100 );
			@define ( _height_thumb , 100 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'chinhsach':
			$title_main = "Chính sách";
			$config_images = "true";
			$config_mota= "false";
			$config_noidung= "true";
			$config_noibat = "false";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			@define ( _width_thumb , 290 );
			@define ( _height_thumb , 290 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			break;

		case 'album':
			$title_main = "Bộ sưu tập";
			$config_images = "true";
			$config_mota= "false";
			$config_noibat = "false";
			$config_noidung = 'false';
			$config_list = "false";
			@define ( _width_thumb , 800 );
			@define ( _height_thumb , 500 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
		break;

		case 'video':
			$title_main = "Video clip";
			$config_images = "false";
			$config_mota= "true";
			$config_noibat = "true";
			$config_list = "false";
			$config_cat = "false";
			$config_item = "false";
			$config_sub = "false";
			@define ( _width_thumb , 800 );
			@define ( _height_thumb , 500 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
		break;
		//-------------info------------------
		case 'gioithieu':
			$title_main = 'Giới thiệu';
			$config_ten = 'false';
			$config_mota = 'false';
			$config_mota2 = 'false';
			$config_images = 'false';
			$config_noidung = 'true';
			@define ( _width_thumb , 577 );
			@define ( _height_thumb , 350 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			break;

		case 'des_dknt':
			$title_main = 'Quy đổi kích thước';
			$config_ten = 'false';
			$config_mota = 'false';
			$config_mota2 = 'true';
			$config_images = 'false';
			$config_noidung = 'false';
			$config_noseo = 'true';
			@define ( _width_thumb , 563 );
			@define ( _height_thumb , 333 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			break;

		case 'des_why':
			$title_main = 'Mô tả đăng ký nhận tin';
			$config_ten = 'false';
			$config_mota = 'true';
			$config_noidung = 'false';
			$config_images = 'false';
			$config_noseo = 'true';
			@define ( _width_thumb , 547 );
			@define ( _height_thumb , 390 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			break;
		
		case 'lienhe':
			$title_main = 'Liên hệ';
			$config_ten = 'true';
			break;

		
		case 'bgemail':
			$title_main = 'Background Đăng ký nhận tin';
			$config_multi_lang = "false";
			@define ( _width_thumb , 1366 );
			@define ( _height_thumb , 495);
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF|swf' );
			$ratio_ = 1;
			break;
		case 'qc':
			$title_main = 'Banner quảng cáo 1';
			$config_multi_lang = "false";
			@define ( _width_thumb , 1366 );
			@define ( _height_thumb , 260);
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF|swf' );
			$ratio_ = 1;
			$links_ = "true";
			$config_hienthi = "true";
			break;

		case 'qc2':
			$title_main = 'Banner quảng cáo 2';
			$config_multi_lang = "false";
			@define ( _width_thumb , 1366 );
			@define ( _height_thumb , 260);
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF|swf' );
			$ratio_ = 1;
			$links_ = "true";
			$config_hienthi = "true";
			break;

		case 'banner':
			$title_main = 'Banner';
			$config_multi_lang = "false";
			@define ( _width_thumb , 622 );
			@define ( _height_thumb , 75 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF|swf' );
			$ratio_ = 1;
			break;
		case 'bgbanner':
			$title_main = 'Background chứng nhận - video';
			$config_multi_lang = "false";
			$links_ = "false";
			$config_hienthi = "false";
			@define ( _width_thumb , 1366);
			@define ( _height_thumb , 503);
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF|swf' );
			$ratio_ = 1;
			break;
		case 'bocongthuong':
			$title_main = 'Logo bộ công thương';
			$config_multi_lang = "false";
			$links_ = "true";
			$config_hienthi = "true";
			@define ( _width_thumb , 172 );
			@define ( _height_thumb , 64 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;
		case 'logo':
			$title_main = 'Logo';
			$config_multi_lang = "false";
			@define ( _width_thumb , 276 );
			@define ( _height_thumb , 102);
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'logo_dongdau':
			$title_main = 'Logo đóng dấu';
			$config_multi_lang = "false";
			@define ( _width_thumb , 650 );
			@define ( _height_thumb , 650 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;
		case 'popup':
			$title_main = 'Popup';
			$config_multi_lang = "false";
			$links_ = 'true';
			$config_hienthi = 'true';
			@define ( _width_thumb , 900 );
			@define ( _height_thumb , 500 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		

		case 'favicon':
			$title_main = 'Favicon';
			$config_multi_lang = "false";
			@define ( _width_thumb , 40 );
			@define ( _height_thumb , 40 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'bgfooter':
			$title_main = 'background Footer';
			@define ( _width_thumb , 1366 );
			@define ( _height_thumb , 416 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'bgfooter2':
			$title_main = 'background Footer phải';
			@define ( _width_thumb , 688 );
			@define ( _height_thumb , 500 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		//-------------photo------------------
		case 'slider':
			$title_main = "Hình ảnh slider";
			$config_multi_lang = "false";
			$config_list = "false";
			$config_mota = "false";
			@define ( _width_thumb ,1366);
			@define ( _height_thumb ,513);
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			break;

		case 'partner':
		    $title_main = "Đối tác";
		    $config_multi_lang = "false";
			@define ( _width_thumb , 173 );
			@define ( _height_thumb , 98 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "true";
			break;

		case 'gcn':
		    $title_main = "Chứng nhận";
		    $config_multi_lang = "false";
			@define ( _width_thumb , 364 );
			@define ( _height_thumb , 376 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			$links_ = "false";
			break;

		case 'img_kh':
		    $title_main = "Cảm nhận khách hàng";
		    $config_multi_lang = "false";
			@define ( _width_thumb , 364 );
			@define ( _height_thumb , 376 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 2;
			$links_ = "false";
			break;

		case 'slide_pro':
		    $title_main = "Banner danh mục sản phẩm";
		    $config_multi_lang = "false";
			@define ( _width_thumb , 365 );
			@define ( _height_thumb , 572 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			$links_ = "false";
			$config_noibat = 'false';
			$config_list = 'true';
			break;
		

		#lkweb
		case 'mxh':
		    $title_main = "Mạng xã hội";
		    $config_link = "true";
		    $config_images= "true";
			$config_ngonngu= "false";
			@define ( _width_thumb , 40 );
			@define ( _height_thumb , 40 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;
		case 'lkweb3':
		    $title_main = "Hỗ trợ online";
		    $config_txt = 'false';
		    $text_txt = 'Số Hotline';
		    $config_link = "true";
		    $config_images= "true";
			$config_ngonngu= "false";
			@define ( _width_thumb , 32 );
			@define ( _height_thumb , 32 );
			@define ( _style_thumb , 1 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'mucgia':
			$title_main = "Mức giá";
			$config_giatri = "false";
			$config_khoang = "true";
			$config_images = "false";
			$config_noibat = "false";
			$config_color = "false";
			$config_noseo = "true";
			@define ( _width_thumb , 586 );
			@define ( _height_thumb , 320 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'size':
			$title_main = "Size";
			$config_giatri = "false";
			$config_khoang = "false";
			$config_images = "false";
			$config_noibat = "false";
			$config_color = "false";
			$config_noseo = "true";
			@define ( _width_thumb , 586 );
			@define ( _height_thumb , 320 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'sex':
			$title_main = "Giới tính";
			$config_giatri = "false";
			$config_khoang = "false";
			$config_images = "false";
			$config_noibat = "false";
			$config_color = "false";
			$config_noseo = "true";
			@define ( _width_thumb , 586 );
			@define ( _height_thumb , 320 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'chatlieu':
			$title_main = "Chất liệu";
			$config_giatri = "false";
			$config_khoang = "false";
			$config_images = "false";
			$config_noibat = "false";
			$config_color = "false";
			$config_noseo = "true";
			@define ( _width_thumb , 586 );
			@define ( _height_thumb , 320 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		case 'mausac':
			$title_main = "Màu sắc";
			$config_giatri = "false";
			$config_khoang = "false";
			$config_images = "false";
			$config_noibat = "false";
			$config_color = "true";
			$config_noseo = "true";
			@define ( _width_thumb , 586 );
			@define ( _height_thumb , 320 );
			@define ( _style_thumb , 2 );
			@define ( _img_type , 'jpg|gif|png|jpeg|PNG|JPG|JPEG|GIF' );
			$ratio_ = 1;
			break;

		
		case 'tags':
			$title_main = 'Tags';
			break;
		case 'lang':
			$title_main = 'Define ngôn ngữ';
			$config_multi_lang = "true";
			break;
		case 'title':
			$title_main = 'Quản lý title,keywords,description';
			$config_developer = "true";
			$config_delete = "true";
			break;
		//--------------defaut---------------
		default: 
			$source = "";
			$template = "index";
			break;
	}

?>