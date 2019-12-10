<div class="sub_main">
<div class="wrap_name">
	<div class="name"><h1><?=$title_detail?></h1></div>
	<div class="bong_name"></div>
</div>
<form action="thanh-toan" method="POST">
  	<div class="content_main content_pay">
  		<div class="thongtin_pay">
  			<div class="title_pay">Thông tin đơn hàng</div>
  			
	  			<div class="content_frm">
  					<div class="form-group">
  						<input type="text" name="hotenpay" required="required" class="form-control" placeholder="<?=_hovaten?>" value="<?=$_SESSION['loginuser']['ten']?>" >
  					</div>
  					<div class="form-group">
  						<input type="text" name="dienthoaipay" required="required" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" class="form-control" placeholder="<?=_dienthoai?>" value="<?=$_SESSION['loginuser']['dienthoai']?>">
  					</div>
  					<div class="form-group">
  						<input type="text" name="emailpay" required="required" class="form-control" placeholder="Email" value="<?=$_SESSION['loginuser']['email']?>" >
  					</div>
  					<div class="form-group form_pay">
  						<select class="form-control" name="tinhthanh" id="tinhthanh">
		                    <option value=""><?=_tinhthanh?></option>
			                <?php foreach ($tinhthanh as $key => $value) { ?>
			                    <option <?=$_SESSION['loginuser']['id_city']==$value['id'] ? "selected" : ""?> value="<?=$value['id']?>"><?=$value['ten']?></option>
			                <?php } ?>
		                </select>
		                <select class="form-control" name="quanhuyen" id="quanhuyen">
		                    <option value=""><?=_quanhuyen?></option>
		                    <?php foreach ($result_dist as $key => $value) { ?>
			                    <option <?=$_SESSION['loginuser']['id_district']==$value['id'] ? "selected" : ""?> value="<?=$value['id']?>"><?=$value['ten']?></option>
			                <?php } ?>
		                </select>
		                <div class="clear"></div>
  					</div>
  					<div class="form-group">
  						<input type="text" name="diachipay" required="required" class="form-control" placeholder="<?=_diachi?>" value="<?=$_SESSION['loginuser']['diachi']?>" >
  					</div>
  					<div class="form-group">
  						<textarea name="noidungpay" id="noidungpay" class="form-control" rows="5" placeholder="<?=_ghichu?>"></textarea>
  					</div>
	  			</div>
	  			
  		</div>
  		<div class="httt_pay">
  			<div class="title_pay"><?=_hinhthucthanhtoan?></div>
			<?php foreach ($httt as $key => $value) { ?>
				<div class="radio">
				    <input id="radio-<?=$key?>" value="<?=$value['id']?>" name="httt" type="radio" <?=($key==0)?'checked':''?>>
				    <label for="radio-<?=$key?>" class="radio-label"><?=$value['ten_'.$lang]?></label>
				    <div class="clear"></div>
				</div>
				<div class="content_httt <?=($key==0)?'active':''?>" id="httt<?=$value['id']?>">
					<?=$value['noidung_'.$lang]?>
				</div>
			<?php } ?>
  		</div>
  		<div class="info_cart">
  			<div class="title_pay"><?=_hoadonmuahang?></div>
			<div class="contain_hoadon">
				<?php
					$max=count($_SESSION['cart']);
					for ($i=0;$i<$max;$i++) { 
					#======================================
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$size_pro=$_SESSION['cart'][$i]['size'];
					$color_pro = $_SESSION['cart'][$i]['color'];
					$md5_pro = $_SESSION['cart'][$i]['md5'];

					$row_price = get_price_by_size($pid,$size_pro);
					#======================================
				?>
					<div class="item_cart_pay">
						<div class="img_pay"><img class="w100" src="thumb/208x228/1/<?=_upload_product_l.get_thumb($pid)?>" alt="<?=$pname?>"></div>
						<div class="info_cart_pay">
							<b><?=get_product_name($pid)?></b>
							<?php if(!empty($size_pro)) {?><p class="txt">Size: <?=get_feild_thuoctinh('ten_'.$lang,'size',$size_pro);?></p><?php } ?>
							<?php if(!empty($color_pro)) {?><p class="txt">Màu <?=get_feild_thuoctinh('ten_'.$lang,'mausac',$color_pro);?></p><?php } ?>
							<span class="gia_pay"><?=$q?> x <?=number_format($row_price['giaban'],0, ',', '.') ?>đ</span>
						</div>
						<div class="clear"></div>
					</div>
				<?php } ?>
			</div>
	    	<div class="content_price_pay">
	    		<ul>
	    			<!-- <li><span><?=_tongdonhang?>: </span><span class="info"><?=number_format(get_order_total(),0, ',', '.')?> đ</span></li> -->
	    			<!-- <li><span><?=_phivanchuyen?>: </span><span id="phiship" class="info">0 đ</span></li> -->
	    			<li><span><?=_tongtien?>: </span><span id="tong" class="info"><?=number_format(get_order_total(),0, ',', '.')?> đ</span></li>
	    		</ul>
	    	</div>
	    	<input type="submit" value="<?=_dathang?>" class="btnPay">
	    </div>
	    <div class="clear"></div>
  	</div><!--content main-->
</form>
</div><!--sub main-->