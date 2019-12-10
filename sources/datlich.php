<?php if(!defined('_source')) die("Error");

	
	if(!empty($_POST)){
			
		// $recaptcha_response = $_POST['recaptcha_response_contact'];
	 //    $ch = curl_init();

		// curl_setopt_array($ch,array(
		//     CURLOPT_URL => $api_url,
		//     CURLOPT_RETURNTRANSFER => true,
  //           CURLOPT_ENCODING => "",
  //           CURLOPT_MAXREDIRS => 10,
  //           CURLOPT_TIMEOUT => 30,
  //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		//     CURLOPT_CUSTOMREQUEST => "POST",
		//     CURLOPT_POSTFIELDS => array(
		//        'secret' => $secret_key,
		//        'response' => $recaptcha_response,
		//     )
		// ));
		// $recaptcha = curl_exec($ch);

		// curl_close($recaptcha);

	 //    $recaptcha = json_decode($recaptcha);

	   
	 //    if($recaptcha->score >= 0.5 && $recaptcha->action=='contact') {

	 //    }else{
	 //    	transfer("Xin lỗi quý khách.<br>Bạn đang cố spam dữ liệu.", "//".$config_url."/lien-he");
	 //    }

			$data1['ten'] = $d->escape_str($_POST['hoten']);
			$data1['dienthoai'] = $d->escape_str($_POST['dienthoai']);
			$data1['email'] = $d->escape_str($_POST['email']);
			$data1['tieude'] = 'ĐẶT LỊCH';
			$txt_dichvu = '';
			if(!empty($_POST['loai_dv'])){
				$txt_dichvu = 'Dịch vụ: '.$d->escape_str($_POST['loai_dv']).'<br>';
			}
			$data1['noidung'] =  $txt_dichvu.'Ngày giờ: '.$d->escape_str($_POST['ngaygio']);
			
			$data1['type'] = "contact";
			$data1['ngaytao'] = time();
			$d->setTable('contact');
			$d->insert($data1);

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
			$mail->Subject    = 'THÔNG TIN ĐẶT LỊCH TỪ WEBSITE '.$config_url;
			$mail->IsHTML(true);
			//Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";	
			$body = '<table>';
			$body .= '
				<tr> 
					<th colspan="2">&nbsp;</th>
				</tr>

				<tr>
					<th colspan="2">Thông tin đặt lịch từ website <a href="'.$http.$config_url.'">'.$config_url.'</a></th>
				</tr>

				<tr>
					<th colspan="2">&nbsp;</th>
				</tr>

				<tr>
					<th>Họ tên :</th><td>'.$_POST['hoten'].'</td>
				</tr>

				<tr>
					<th>Điện thoại :</th><td>'.$_POST['dienthoai'].'</td>
				</tr>

				<tr>
					<th>Email :</th><td>'.$_POST['email'].'</td>
				</tr>
				';
				if(!empty($txt_dichvu)){ 
					$body.='
				<tr>
					<th>Loại dịch vụ :</th><td>'.$_POST['loai_dv'].'</td>
				</tr>';
				 } 
			$body.='
				<tr>
					<th>Ngày giờ:</th><td>'.$_POST['ngaygio'].'</td>
				</tr>';
			$body .= '</table>';



				
			$mail->Body = $body;

			if($data1['photo']){
				$mail->AddAttachment(_upload_hinhanh_l.$data1['photo']);
			}
			$mail->Send();
			
			transfer("Thông tin đặt lịch đã được gửi. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất. Cảm ơn.", "//".$config_url."/");
		
	}
?>