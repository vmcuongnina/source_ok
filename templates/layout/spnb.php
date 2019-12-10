<div class="wrap_name">
  <div class="name">Sản phẩm tiêu biểu</div>
  <div class="bong_name"></div>
</div>  
<div class="swiper-dmsp">
  <div class="swiper-wrapper">
    <?php 
    $d->reset();
    $d->query("select ten_$lang as ten,id,tenkhongdau,photo,giaban,giacu,name_$lang as name from #_product where  type='product' and hienthi=1 and banchay=1 order by stt,id desc");
    $arr_spnb = $d->result_array();
    if(!empty($arr_spnb)){ 
        foreach($arr_spnb as $spnb){ ?>
          <div class="swiper-slide">
              <div class="item_dv">
                <div class="img">
                  <a href="<?=$spnb['tenkhongdau']?>">
                    <img class="img-responsive" src="thumb/280x355/2/<?=_upload_product_l.$spnb['photo']?>" alt="<?=$spnb['ten']?>"><div class="icon"></div>
                    <?php if(!empty($spnb['name'])){ ?><div class="txt"><?=$spnb['name']?></div><?php } ?>
                    <?php if($spnb['giacu']>0){ ?><div class="sale"><?=get_sale($spnb['giacu'],$spnb['giaban']);?></div><?php } ?>
                  </a>
                </div>
                <div class="info">
                  <div class="name"><h3><a href="<?=$spnb['tenkhongdau']?>"><?=$spnb['ten']?></a></h3></div>
                  <div class="price">
                    <span class="giaban"><?php if($spnb['giaban']>0) echo number_format($spnb['giaban'],0,',','.').'đ';else echo 'Liên hệ'; ?></span>
                    <?php if($spnb['giacu']>0){ ?><span class="giacu"><?=number_format($spnb['giacu'],0,',','.').'đ'; ?></span><?php } ?>
                    <div class="buy"><a href="<?=$spnb['tenkhongdau']?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> MUA</a></div>
                  </div>
                </div>
              </div>
          </div>
      <?php } ?>
      <div class="swiper-pagination"></div>
    <?php } ?>
  </div>
</div>