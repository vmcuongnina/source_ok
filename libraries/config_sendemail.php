<?php  
	if($config['debug']==1){
		$mail->Priority = 1;
		$mail->AddCustomHeader("X-MSMail-Priority: High");		
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;  
		$mail->SMTPAuth   = true; 
		$mail->SMTPSecure = "tls";           
		$mail->Host       = "smtp.gmail.com";  
		$mail->Port       = 587;                  
		$mail->Username   = "demo86.ninavietnam@gmail.com";  
		$mail->Password   = "asbneusjkhnvenvm";
		$mail->SetFrom("demo86.ninavietnam@gmail.com",$row_setting['ten_'.$lang]);
	}else{
		$mail->IsSMTP(); // Gọi đến class xử lý SMTP
		$mail->Host       = $config_ip; // tên SMTP server
		$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
		$mail->Username   = $config_email; // SMTP account username
		$mail->Password   = $config_pass;  
		$mail->SetFrom($config_email,$row_setting['ten_'.$lang]);
	}
?>