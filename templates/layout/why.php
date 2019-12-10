<div class="list_why">
  <?php 
  $d->reset();
  $d->query("select ten_$lang as ten,id,tenkhongdau,photo,mota_$lang as mota from #_baiviet where  type='visao' and hienthi=1 order by stt,id desc");
  $arr_dv = $d->result_array();
  if(!empty($arr_dv)){ ?>
    <div class="swiper-dv">
      <div class="swiper-wrapper">
        <?php foreach($arr_dv as $dmdv){ ?>
            <div class="swiper-slide">
              <div class="item_why">
                <div class="img"><img class="img-responsive lazy" data-src="thumb/100x100/2/<?=_upload_baiviet_l.$dmdv['photo']?>" alt="<?=$dmdv['ten']?>"></div>
                <div class="info">
                  <div class="name"><?=$dmdv['ten']?></div>
                  <div class="des"><?=$dmdv['mota']?></div>
                </div>
              </div>
            </div>
        <?php } ?>
      </div>
    </div>
  
  <?php } ?>
</div>