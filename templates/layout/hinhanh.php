<div class="wrap_name">
  <div class="name">hình ảnh hoạt động</div>
  <div class="bong_name"></div>
</div>
<div class="list_img_home">
	<?php  
	$d->reset();
	$d->query("select photo_vi,ten_$lang as ten from #_photo where hienthi=1 and type='hoatdong' order by stt, id desc");
	$arr_hinh = $d->result_array();
	if(!empty($arr_hinh)){ ?>
		<ul id="itemContainer_img" class="ul_home">
		<?php foreach ($arr_hinh as $key => $value) { 
			?>
			<li class="col-img col-md-3 col-sm-4 col-xs-6">
				<div class="item_img">
					<a class="fcb" data-fancybox="hoatdong" href="<?=_upload_hinhanh_l.$value['photo_vi']?>" data-caption="<?=$value['ten']?>"><img class="img-responsive" alt="<?=$value['ten']?>" src="thumb/273x246/1/<?=_upload_hinhanh_l.$value['photo_vi']?>"/></a>
				</div>
			</li>
		<?php } ?>
		</ul>
		<div class="clearfix"></div>
		<div class="paging"><div class="holder holder_img"></div></div>
	<?php } ?>
	
</div>