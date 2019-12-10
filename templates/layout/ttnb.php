<div class="name_home"><span>tin tức nổi bật</span></div>
<div class="list_dv">
  <?php 
  $d->reset();
  $d->query("select ten_$lang as ten,id,tenkhongdau,photo,mota_$lang as mota,ngaytao from #_baiviet where  type='tintuc' and hienthi=1 and noibat=1 order by stt,id desc");
  $arr_ttnb = $d->result_array();
  if(!empty($arr_ttnb)){ ?>
    <div class="swiper-tt">
      <div class="swiper-wrapper">
          <?php foreach($arr_ttnb as $ttnb){ ?>
              <div class="swiper-slide">
                <div class="item_ttnb">
                  <div class="img">
                    <a href="<?=$ttnb['tenkhongdau']?>">
                      <img class="img-responsive" src="thumb/375x290/1/<?=_upload_baiviet_l.$ttnb['photo']?>" alt="<?=$ttnb['ten']?>">
                      <div class="icon">
                        <p class="ngay"><?=date('d',$ttnb['ngaytao']);?></p>
                        <p class="line"></p>
                        <p class="thang">Tháng <?=date('m',$ttnb['ngaytao']);?></p>
                      </div>
                    </a>
                  </div>
                  <div class="info">
                    <div class="name"><a href="<?=$ttnb['tenkhongdau']?>"><?=$ttnb['ten']?></a></div>
                    <div class="des"><?=$ttnb['mota']?></div>
                  </div>
                </div>
              </div>
          <?php } ?>
      </div>
    </div>
  <?php } ?>
</div>