<div class="frm_dknt2">
	<div class="name">đăng ký nhận tin</div>
	<div class="txt">
		<?php  
		$d->reset();
		$sql = "select mota_$lang from #_info where type='des_why'";
		$d->query($sql);
		$txtdknt = $d->fetch_array();
		echo nl2br($txtdknt['mota_'.$lang]);
		?>
	</div>
	<div class="wrap_dknt">
		<div class="col-frm">
			<form method="post" name="frm" id="frm" action="index.php" enctype="multipart/form-data">
			  <div class="frm_contact2">
			    <input name="ten" type="text"  id="ten" size="50" required="required" placeholder="<?=_hovaten?>"/>
			    <input name="dienthoai" type="text" id="dienthoai" size="50" required="required" placeholder="<?=_dienthoai?>"/>
			    <input name="email" type="email"  size="50" id="email" required="required" placeholder="Email"/>
			    <textarea id="noidung" name="noidung" cols="50" rows="3" placeholder="Nội dung"></textarea>
			    <div class="btn_action">
			    	<input type="hidden" id="recaptchaResponseEmail" name="recaptcha_response">
			      <input type="submit" value="GỬI" class="btn btn-success" name="sub_dv">
			    </div>
			  </div>
			</form>
		</div>
	</div>
	
</div>