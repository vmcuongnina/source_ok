<?php
$d->reset();
$sql = "select mota_$lang,photo,ten_$lang from #_info where type='gioithieu'";
$d->query($sql);
$abouthome = $d->fetch_array();
?>
<div class="img_about_home col-md-6 col-sm-6 col-xs-12">
  <a href="gioi-thieu"><img data-src="<?='thumb/577x350/2/'._upload_hinhanh_l.$abouthome['photo']?>" alt="<?=$abouthome['ten_'.$lang]?>" class="img-responsive lazy"></a>
</div>
<div class="content_about_home col-md-6 col-sm-6 col-xs-12">
	<div class="des_about"><?=$abouthome['mota_'.$lang]?></div>
	<div class="view_about"><a href="gioi-thieu">Xem Thêm</a></div>
</div>

<div class="clearfix"></div>