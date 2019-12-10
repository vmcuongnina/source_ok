<?php
if($_SESSION['loginuser']){
	transfer("Vui lòng đăng xuất tài khoản trước khi đăng nhập tài khoản khác!", "index.html",1);
}
if(!empty($_POST)&& isset($_POST['username'])){

	global $d, $login_name;

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "select * from #_thanhvien where email='".$username."'";
	$d->reset();
	$d->query($sql);
	if($d->num_rows() == 1){
		$row = $d->fetch_array();
		if($row['active']!=1){
			transfer("Bạn phải kích hoạt tài khoản của mình trước khi đăng nhập","dang-nhap",1);
		}else{
			if($row['password'] == encrypt_password($password,$config['salt'])){
				$_SESSION['loginuser'] = $row;
				$data1['lastlogin'] = time();
				$d->reset();
				$d->setTable("thanhvien");
				$d->setWhere("id",$row['id']);
				$d->update($data1);
				header("Location: ".$http.$config_url);
			}else{
				transfer("Mật khẩu không đúng", "dang-nhap",1);
			}
		}
	}else{
		transfer("Tài khoản không tồn tại", "dang-nhap",1);
	}
}

	$title_bar = "Đăng nhập";
?>
