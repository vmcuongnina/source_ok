<?php
    $d->reset();
    $sql= "select ten_$lang,link,photo_vi from #_photo where hienthi=1 and type='partner' order by stt,id desc";
    $d->query($sql);
    $doitac = $d->result_array();
?>
<div class="wrap">
	<div class="swiper-dt">
	    <div class="swiper-wrapper">
			<?php for($j=0,$count_ch=count($doitac);$j<$count_ch;$j++){?>
				<div class="swiper-slide">
					<a href="<?=$doitac[$j]['link']?>" target="_blank">
						<img src="thumb/173x98/2/<?=_upload_hinhanh_l.$doitac[$j]['photo_vi']?>" alt="<?=$doitac[$j]['ten_'.$lang]?>" class="img_dt img-responsive" />
			        </a>
		        </div>
			<?php } ?>
		</div>
	</div>
	<div class="next_doitac"></div>
	<div class="prev_doitac"></div>
</div>