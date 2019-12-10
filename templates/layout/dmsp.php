<?php 
$d->reset();
$d->query("select ten_$lang as ten,tenkhongdau,photo from #_product_list where  type='product' and hienthi=1 order by stt,id desc");
$arr_dmsp = $d->result_array();
if(!empty($arr_dmsp)){ ?>
  <div class="swiper-dmsp">
    <div class="swiper-wrapper">
        <?php foreach($arr_dmsp as $dmsp){ ?>
            <div class="swiper-slide">
              <div class="item_dmsp">
                  <a href="<?=$dmsp['tenkhongdau']?>">
                    <div class="img"><img class="img-responsive" src="thumb/50x64/2/<?=_upload_product_l.$dmsp['photo']?>" alt="<?=$dmsp['ten']?>"></div>
                    <div class="info">
                      <div class="name"><?=$dmsp['ten']?></div>
                      <div class="view">Xem chi tiết >></div>
                    </div>
                    <div class="clearfix"></div>
                  </a>
              </div>
            </div>
        <?php } ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
<?php } ?>