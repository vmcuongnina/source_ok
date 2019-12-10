<div class="col_left_cart col-md-9 col-sm-9 col-xs-12">
	<div id="shopping-cart">
	<?php
		$max=count($_SESSION['cart']); 
		$total_price = get_order_total();
		for ($i=0; $i < $max; $i++) { 
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$size_pro=$_SESSION['cart'][$i]['size'];
			$color_pro = $_SESSION['cart'][$i]['color'];
			$md5_pro = $_SESSION['cart'][$i]['md5'];

			$row_price = get_price_by_size($pid,$size_pro);
	?>
		<div class="shopping-cart-item clearfix">
			<div class="img-thumnail-custom">
				<p class="image">
					<img class="img-responsive" src="<?=$config_http.$config_url.'/'._upload_product_l.get_thumb($pid)?>">
				</p>
			</div>
			<div class="col-right">
				<div class="box-info-product">
					<p class="name"><a href="<?=get_col_pro($pid,'tenkhongdau')?>" target="_blank"><?=get_product_name($pid)?></a></p>
					<?php if(!empty($size_pro)) {?><p class="txt">Size: <?=get_feild_thuoctinh('ten_'.$lang,'size',$size_pro);?></p><?php } ?>
					<?php if(!empty($color_pro)) {?><p class="txt">Màu <?=get_feild_thuoctinh('ten_'.$lang,'mausac',$color_pro);?></p><?php } ?>
				</div>
				<div class="box-price">
					<p class="price"><?=number_format($row_price['giaban'],0,',','.')?>&nbsp;₫</p>
					<?php if($row_price['giacu']>0) {?><p class="price2"><?=number_format($row_price['giacu'],0,',','.')?>&nbsp;₫</p><?php } ?>
				</div>
				<div class="quantity-block">
					<div class="input-group bootstrap-touchspin">
						<span class="input-group-btn">
							<button class="btn btn-default bootstrap-touchspin-down minius_cart" type="button" data-id="<?=$md5_pro?>">-</button>
						</span>
						<span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
						<input type="tel" class="form-control quantity-r2 js-quantity-product qty_pro" id="<?=$md5_pro?>" min="1" data-md5="<?=$md5_pro?>" value="<?=$q?>" style="display: block;">
						<span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span>
						<span class="input-group-btn">
							<button class="btn btn-default bootstrap-touchspin-up plus_cart" type="button" data-id="<?=$md5_pro?>">+</button>
						</span>
					</div>
					<p class="action">
						<a href="javascript:del('<?=$md5_pro?>')" class="item-delete" data-title="<?=get_product_name($pid)?>">Xóa</a>
					</p>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
</div>
<div class="col_right_cart col-md-3 col-sm-3 col-xs-12">
	<div class="info_pay">
		<ul>
			<!-- <li>Tạm tính:  <span class="price-temp"><?=number_format($total_price,0, ',', '.')?>&nbsp;₫</span></li> -->
			<li>Thành tiền: <span class="price-all"><?=number_format($total_price,0, ',', '.')?>&nbsp;₫</span></li>
		</ul>
	</div>
	<a class="btn btn-danger btn-block btn-pay" href="thanh-toan">Tiến hành thanh toán</a>
</div>