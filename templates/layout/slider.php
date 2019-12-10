<div class="nivo">
	<?php 
	$d->reset();
	$d->query("select ten_vi,id,link,photo_vi as photo,thumb_vi as thumb from #_photo where hienthi=1 and type='slider' order by id asc");
	$slider = $d->result_array();
	if(!empty($slider)){
	?>
	 <?php foreach ($slider as $key => $value) { ?>
	 	<a href="<?=$value['link']?>" title="<?=$value['ten']?>">
			<img src="<?=_upload_hinhanh_l.$value['photo']?>" alt="<?=$value['ten']?>" />
		</a>
	 <?php } } ?>
</div>