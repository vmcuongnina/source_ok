<?php if(!defined('_source')) die("Error");
		
	$d->reset();
	$sql = "select noidung_$lang,title,keywords,description from #_company where type='lienhe' ";
	$d->query($sql);
	$row_detail = $d->fetch_array();

	$keywords_bar = $row_setting['keywords'];
	$description_bar = $row_setting['description'];

	$arr_bread[1]['name'] = $title_detail;
	$arr_bread[1]['link'] = getCurrentPageURL(); 
	$arr_bread[1]['pos'] = 2;
	
	if(!empty($_POST)){
			
		$recaptcha_response = $_POST['recaptcha_response'];
		  $ch = curl_init();

		    curl_setopt_array($ch, array(
		       CURLOPT_URL => $api_url,
		       CURLOPT_RETURNTRANSFER => true,
		       CURLOPT_ENCODING => "",
		       CURLOPT_MAXREDIRS => 10,
		       CURLOPT_TIMEOUT => 30,
		       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		       CURLOPT_CUSTOMREQUEST => "POST",
		       CURLOPT_POSTFIELDS => array(
		           'secret' => $secret_key,
		           'response' => $recaptcha_response,
		       )
		    ));
		    $recaptcha = curl_exec($ch);

		    curl_close($recaptcha);

		  $recaptcha = json_decode($recaptcha);
		  //Nếu multi Recaptcha thì thêm điều kiện action đúng với action đã đặt 
		  if($recaptcha->score >= 0.5 && $recaptcha->action=='contact') { 

		  }else{
		       transfer("Dangerous detection. Please try again later.","//".$config_url."/lien-he");
		  }

			$file_name = images_name($_FILES['file']['name']);
			if($file_att = upload_image("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|xlsx|jpg|png|gif|JPG|PNG|GIF', _upload_hinhanh_l,$file_name)){
				$data1['photo'] = $file_att;
				
			}

			include_once "phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			include _lib.'config_sendemail.php';

			//Thiet lap thong tin nguoi gui va email nguoi gui
			$mail->SetFrom($config_email,$row_setting['ten_'.$lang]);
			
			$mail->AddAddress($row_setting['email'],$row_setting['ten_'.$lang]);
			
			/*=====================================
			 * THIET LAP NOI DUNG EMAIL
	 		*=====================================*/

			//Thiết lập tiêu đề
			$mail->Subject    = 'THƯ LIÊN HỆ TỪ WEBSITE '.$config_url;
			$mail->IsHTML(true);
			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";	
			$body = '<table>';
			$body .= '
				<tr> 
					<th colspan="2">&nbsp;</th>
				</tr>

				<tr>
					<th colspan="2">Thư liên hệ từ website <a href="'.$http.$config_url.'">'.$config_url.'</a></th>
				</tr>

				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>

				<tr>
					<th>Họ tên :</th><td>'.$_POST['ten'].'</td>
				</tr>

				<tr>
					<th>Điện thoại :</th><td>'.$_POST['dienthoai'].'</td>
				</tr>';
				if(!empty($_POST['diachi'])){
					$body .= '
							<tr>
								<th>Địa chỉ:</th><td>'.$_POST['diachi'].'</td>
							</tr>
					';
				}
			$body .= '
				<tr>
					<th>Email :</th><td>'.$_POST['email'].'</td>
				</tr>
				
			
				<tr>
					<th>Nội dung :</th><td>'.$_POST['noidung'].'</td>
				</tr>';
			$body .= '</table>';

			$data1['ten'] = $d->escape_str($_POST['ten']);
			$data1['diachi'] = $d->escape_str($_POST['diachi']);
			$data1['dienthoai'] = $d->escape_str($_POST['dienthoai']);
			$data1['email'] = $d->escape_str($_POST['email']);
			if(!empty($_POST['sub_dv'])){
				$data1['tieude'] = 'ĐẶT DỊCH VỤ NHANH';
			}else{
				$data1['tieude'] = $d->escape_str($_POST['tieude']);
			}
			
			$data1['noidung'] = $d->escape_str($_POST['noidung']);
			$data1['stt'] = $_POST['stt'];
			$data1['type'] = "contact";
			$data1['ngaytao'] = time();
			$d->setTable('contact');
			$d->insert($data1);

				
			$mail->Body = $body;

			if($data1['photo']){
				$mail->AddAttachment(_upload_hinhanh_l.$data1['photo']);
			}
		
			$mail->Send();
			
			transfer("Thông tin liên hệ được gửi . Cảm ơn.", "//".$config_url."/lien-he");
		
	}
?>