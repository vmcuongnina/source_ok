<?php
$d->reset();
$sql_banner_top= "select photo_vi from #_photo where type='bgfooter'";
$d->query($sql_banner_top);
$bgfooter = $d->fetch_array();

$d->reset();
$sql_banner_top= "select thumb_$lang,hienthi,link from #_photo where type='bocongthuong'";
$d->query($sql_banner_top);
$logo_congthuong = $d->fetch_array();

$d->reset();
$sql = "select id,tenkhongdau,ten_$lang from #_baiviet where hienthi=1 and type='chinhsach' order by stt, id desc";
$d->query($sql);
$arr_cs = $d->result_array();
?>
<div id="footer" class="full_bg full_bg_mobile">
	<div class="container">

			<div class="col-foot item_footer cont_foot col-foot-1">
				<div class="content_foot">
					<?php
				  $d->reset();
				  $sql = "select noidung_$lang from #_company where type='footer'";
				  $d->query($sql);
				  $footer = $d->fetch_array();
				  echo $footer['noidung_'.$lang];
				  ?>
			  	</div>
			</div>
			<div class="col-foot item_footer col-foot-2">
				<?php include _template."layout/dknt2.php";?>
			</div>

			<div class="col-foot item_footer col-foot-3">
				<div class="fb-page" data-href="<?=$row_setting['facebook']?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=$row_setting['facebook']?>" class="fb-xfbml-parse-ignore"><a href="<?=$row_setting['facebook']?>"><?=$row_setting['ten_'.$lang]?></a></blockquote></div>

				<div class="mxh_f">
					<?php 
					if(!empty($mxh)){
					foreach ($mxh as $key => $value) { ?>
						<a href="<?=$value['url']?>" title="<?=$value['ten']?>"><img src="thumb/38x38/2/<?=_upload_hinhanh_l.$value['photo']?>" alt="<?=$value['ten']?>"></a>
					<?php } } ?>
				</div>
			</div>
		
	</div>

	<div id="bottom">
		<div class="container">
			<div class="col-copy col-md-7 col-sm-12 col-xs-12">
				&copy; 2019 <span><?=$row_setting['slogan_'.$lang]?></span>. Design by <span>Nina.vn</span>
			</div>
			<div class="col-tk col-md-5 col-sm-12 col-xs-12">
				<a href="chinh-sach">CHÍNH SÁCH</a>
				<span>|</span>
				<a href="lien-he">LIÊN HỆ</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

