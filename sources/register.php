<?php if(!defined('_source')) die("Error");
	if($_SESSION['loginuser']){
		transfer("Bạn vui lòng đăng xuất tài khoản!.", "//".$config_url."/");
	}
	$time =  time();

	$mathanhvien=ChuoiNgauNhien(6).$time;

	$title_bar = "Đăng ký tài khoản";

	$d->reset();
	$d->query("select ten,id from #_place_city where hienthi=1 order by id asc");
	$city = $d->result_array();


	if(isset($_POST) && isset($_POST['recapcha_register'])){

		$recaptcha_response = $_POST['recapcha_register'];
	    $ch = curl_init();

		curl_setopt_array($ch,array(
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
	    

	    if($recaptcha->score >= 0.5 && $recaptcha->action=='register') {

			$d->reset();
			$d->setTable("thanhvien");
			$d->setWhere('email',$_POST['email']);
			$d->select('email');
			if($d->num_rows()>0){
				transfer("Email đã được đăng ký. Vui lòng nhập một email khác.", "dang-ky");
			}

			$d->reset();
			$d->setTable("thanhvien");
			$d->setWhere('dienthoai',$_POST['dienthoai']);
			$d->select('dienthoai');
			if($d->num_rows()>0){
				transfer("Số điện thoại đã được đăng ký. Vui lòng chọn số điện thoại khác.", "dang-ky");
			}


			$data1['email'] = $d->escape_str($_POST['email']);
			$data1['ten'] = $d->escape_str($_POST['hoten']);
			$data1['dienthoai'] = $d->escape_str($_POST['dienthoai']);
			$data1['diachi'] = $d->escape_str($_POST['diachi']);
			$data1['id_district'] = (int)$_POST['quanhuyen'];
			$data1['id_city'] = (int)$_POST['tinhthanh'];
			$data1['password'] = md5(sha1($_POST['password'].$config['salt']));
			$data1['mathanhvien'] = $mathanhvien;
			$data1['ngaytao'] = time();
			$data1['active'] = 0;

			$d->reset();
			$d->setTable('thanhvien');
			if($d->insert($data1)){
				$id = mysql_insert_id();
				include_once "phpMailer/class.phpmailer.php";
				$mail = new PHPMailer();

				include _lib.'config_sendemail.php';

				//Thiết lập thông tin người nhận
				$mail->AddAddress($_POST['email'], $_POST['hoten']);

				//Thiết lập tiêu đề
				$mail->Subject    = "Xác nhận tài khoản";
				$mail->IsHTML(true);
				//Thiết lập định dạng font chữ
				$mail->CharSet = "utf-8";

				$body = '<table style="text-align:left;">';
				$body .= '
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">Xin chào '.$_POST['hoten'].'! </td>
						</tr>
						<tr>
							<td colspan="2">Cảm ơn bạn đã đăng ký tài khoản trên '.$http.$config_url.'/ .</td>
						</tr>


						<tr>
							<th width="100px">Username :</th><td> <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a></td>
						</tr>
						<tr>
							<th width="100px">Password : </th><td>'.$_POST['password'].'</td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr>
							<td colspan="2"><i><b>NOTE:</b> Vui lòng Click vào <a href="'.$http.$config_url.'/activated/'.md5($id).'">Tại đây</a> để kích hoạt tài khoản!</td>
						</tr>

						';
					$body .= '</table>';

				$mail->Body = $body;


				if($mail->Send()) {
					transfer("Bạn đã đăng ký thành công <br/> Vui lòng nhập email kích hoạt tài khoản của bạn", "dang-nhap");
				}
				else{
					transfer("Đăng ký không thành công. Vui lòng đăng ký lại.", "dang-ky");
				}
			}
			else{
				transfer("Đăng ký không thành công. Vui lòng đăng ký lại.", "dang-ky");
			}
		}else{
			transfer("Hệ thống cho rằng bạn đang cố spam dữ liệu<br/> Vui lòng ngừng spam!", "//".$config_url."/");
		}
	}
?>
