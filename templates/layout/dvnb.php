<div class="name_dv">Dịch vụ nổi bật</div>
<div class="txt_dv">chúng tôi luôn cung cấp dịch vụ tốt nhất đến khách hàng</div>
<div class="list_dv">
  <?php 
  $d->reset();
  $d->query("select ten_$lang as ten,id,tenkhongdau,photo,mota_$lang as mota from #_baiviet where  type='dichvu' and hienthi=1 and noibat=1 order by stt,id desc");
  $arr_dv = $d->result_array();
  if(!empty($arr_dv)){ ?>
    <div class="swiper-dv">
      <div class="swiper-wrapper">
        <?php foreach($arr_dv as $dmdv){ ?>
            <div class="swiper-slide">
              <div class="item_dvnb">
                <div class="img"><a href="<?=$dmdv['tenkhongdau']?>"><img class="img-responsive lazy" data-src="thumb/250x200/1/<?=_upload_baiviet_l.$dmdv['photo']?>" alt="<?=$dmdv['ten']?>"></a></div>
                <div class="info">
                  <div class="name"><h3><a href="<?=$dmdv['tenkhongdau']?>"><?=$dmdv['ten']?></a></h3></div>
                  <div class="des"><?=$dmdv['mota']?></div>
                  <div class="view"><a href="<?=$dmdv['tenkhongdau']?>">Xem tất cả <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></div>
                </div>
              </div>
            </div>
        <?php } ?>
      </div>
    </div>
  
  <?php } ?>
</div>