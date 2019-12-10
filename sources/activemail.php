<?php if(!defined('_source')) die("Error");
		
	if($_GET['user']!=''){
		$d->reset();
		$sql = "select id from #_thanhvien where md5(id)='".$_GET['user']."'";
		$d->query($sql);
		if($d->num_rows()==1){
			$row_user = $d->fetch_array();
			$data_user['active'] = 1;
			$d->setTable("thanhvien");
			$d->setWhere('id',$row_user['id']);
			if($d->update($data_user)){
				transfer("Kích hoạt tài khoản thành công", "//".$config_url."/dang-nhap");
			}
		}else{
			transfer("Dữ liệu không có thực!", "//".$config_url."/dang-nhap");
		}
	}
?>