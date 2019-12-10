<?php  if(!defined('_source')) die("Error");
    
	if(isset($_POST['sub_dv'])){

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
        if($recaptcha->score >= 0.5 && $recaptcha->action=='email') { 

        }else{
             transfer("Dangerous detection. Please try again later.","//".$config_url."/lien-he");
        }

        $email = $d->escape_str($_POST['email']);
        $dknt_hoten = $d->escape_str($_POST['ten']);
        $dknt_dienthoai = $d->escape_str($_POST['dienthoai']);
        $dknt_noidung = $d->escape_str($_POST['noidung']);
      	$ngaytao = time();

        $d->reset();
        $sql_check = "select * from #_newsletter where email='$email'";
        $d->query($sql_check);
        $check_mail = $d->fetch_array();
        if(empty($check_mail)){ 

            $d->reset();
            $sql = "INSERT INTO table_newsletter(ten,dienthoai,noidung,ngaytao,email) VALUES ('$dknt_hoten','$dknt_dienthoai','$dknt_noidung','$ngaytao','$email')";
            $d->query($sql);

        }
        transfer("Cảm ơn bạn đã đăng ký nhận tin.", "//".$config_url);
       
    }
?>