<div class="sub_main clearfix">
  
  <div class="content_main">
    <div class="row">
      <div class="img_detail col-md-5 col-sm-5 col-xs-12">
        <div class="main_img_detail">
          <a id="Zoomer" href="<?=_upload_product_l.$row_detail['photo']?>" class="MagicZoomPlus" rel="zoom-width:300px; zoom-height:300px;selectors-effect-speed: 600; selectors-class: Active;">
            <img src="<?=_upload_product_l.$row_detail['photo']?>" alt="<?=$row_detail['ten_'.$lang]?>"/>
          </a>
        </div>
        <?php include_once "layout/module/sub_img_detail_h.php"; ?>
      </div>

      <div class="info_detail col-md-7 col-sm-7 col-xs-12">
        <div class="name_pro_detail"><h1><?=$row_detail['ten_'.$lang]?></h1></div>
        <?php if(!empty($row_detail['masp'])) {?><div class="item_info_detail"><b><?=_masanpham?> : </b><?=$row_detail['masp']?></div><?php } ?>

        <div class="price_now"><?=($row_detail['giaban']==0)?'Liên hệ':number_format($row_detail['giaban'],0,',','.')."đ"?></div>
        
        <div class="price_old">
          <?php if($row_detail['giacu']>0){?>
          <span class="num"><?=number_format($row_detail['giacu'],0,',','.')."đ"?></span>
          <span class="off"><?=get_sale($row_detail['giacu'],$row_detail['giaban'],1)?></span>
          <?php } ?>
        </div>
        

        <?php if(!empty($row_detail['arr_id_size'])){ $i=1;
          $arr_size = explode(',',$row_detail['arr_id_size']);
          ?>
            <div class="item_info_detail clearfix">
              <span>SIZE:</span>
              <div class="option-list size-option">
                <?php foreach($arr_size as $s) { 
                  $name_size = get_feild_thuoctinh('ten_'.$lang,'size',$s);?>
                  <button <?php if($i==1) echo 'class="active"'; ?> data-val="<?=$s?>"> <?=$name_size?></button>
                <?php $i++; } ?>
              </div>
            </div>
        <?php } ?>

        <?php if(!empty($row_detail['arr_id_color'])){ $i=1;
          $arr_color = explode(',',$row_detail['arr_id_color']);
          ?>
            <div class="item_info_detail clearfix">
              <span>COLOR:</span>
              <div class="option-list color-option">
                <?php foreach($arr_color as $s) { 
                  $row_mau = get_feild_thuoctinh('ten_'.$lang.',color','mausac',$s,1);?>
                  <button <?php if($i==1) echo 'class="active"'; ?> data-val="<?=$s?>" title="<?=$row_mau['ten_'.$lang]?>" style="background: #<?=$row_mau['color']?>"></button>
                <?php $i++; } ?>
              </div>
            </div>
        <?php } ?>

        <div class="item_info_detail amount_cart clearfix">
          <button id="minus"><i class="fa fa-minus" aria-hidden="true"></i></button>
          <input type="text" min="1" max="99" value="1" class="amount sl" id="qty" readonly>
          <button id="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
          <input type="hidden" id="id_pro" value="<?=@$row_detail['id']?>">
          <input type="hidden" id="color_pro" value="<?=@$arr_color[0]?>">
          <input type="hidden" id="size_pro" value="<?=@$arr_size[0]?>">
          <a class="btn_Cart_Detail buy-now add_cart" id="btn_buy"><i class="fa fa-cart-plus" aria-hidden="true"></i> Mua ngay</a>
        </div>

        <?php if(!empty($row_detail['mota_'.$lang])) { ?>
          <div class="item_info_detail">
            <?=$row_detail['mota_'.$lang]?>
          </div>
        <?php } ?>
        
        <?php if(!empty($row_detail['tags'])) { $arr_tags = explode(',',$row_detail['tags']);?>
          <div class="item_info_detail list_tags">
          <b>Tags</b>:  
          <?php foreach($arr_tags as $tag){ 
                $d->reset();
                $sql = "select id,ten_$lang as ten,tenkhongdau from #_tags where id='$tag'";
                $d->query($sql);
                $item_tag = $d->fetch_array();
            ?>
            <a href="tag/<?=$item_tag['tenkhongdau']?>"><?=$item_tag['ten']?></a>
          <?php } ?>
          </div>
        <?php } ?>

        <div class="item_info_detail">
          <?php include_once _template.'layout/module/share.php'; ?>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="bottom_detail">
        <div class="contain_tab">
            <a href="#noidung_chitiet" class="item_tab active" >THÔNG TIN CHI TIẾT</a>
            <span>|</span>
            <a href="#binhluan" class="item_tab" >BÌNH LUẬN</a>
        </div><!--end contain tab-->
        <div class="clear"></div>
        <div class="contain_content_tab">
            <div id="noidung_chitiet" class="content_tab active ">
                <div class="text">
                    <?=check_ssl_content($row_detail['noidung_'.$lang])?>
                </div>
            </div>
            <div id="binhluan" class="content_tab">
              <div class="fb-comments" data-href="<?=getCurrentPageURL_CANO()?>" data-width="100%" data-numposts="5"></div>
            </div>
        </div>
    </div>
  </div>
</div>
<?php if(count($product)>0){ ?>
<div class="sub_main clearfix">
    <div class="wrap_name">
      <div class="name">Sản phẩm cùng loại</div>
      <div class="bong_name"></div>
    </div>
    <div class="content_main clearfix">
      <div class="swiper-sp">
        <div class="swiper-wrapper">
          <?php foreach ($product as $key => $value) { ?>
                <div class="swiper-slide">
                    <div class="item_dv">
                      <div class="img">
                        <a href="<?=$value['tenkhongdau']?>">
                          <img class="img-responsive lazy" data-src="thumb/262x249/2/<?=_upload_product_l.$value['photo']?>" alt="<?=$value['ten']?>"><div class="icon"></div>
                          <?php if($value['giacu']>0){ ?><div class="sale"><?=get_sale($value['giacu'],$value['giaban'])?></div><?php } ?>
                        </a>
                        <div class="buy" data-id="<?=$value['id']?>"><a href="javascript:void(0);">Thêm vào giỏ hàng</a></div>
                      </div>
                      <div class="info">
                        <div class="name"><h3><a href="<?=$value['tenkhongdau']?>"><?=$value['ten']?></a></h3></div>
                        <div class="price">
                          <span class="giaban"><?php if($value['giaban']>0) echo number_format($value['giaban'],0,',','.').'đ';else echo 'Liên hệ'; ?></span>
                          <?php if($value['giacu']>0){ ?><span class="giacu"><?=number_format($value['giacu'],0,',','.').'đ'; ?></span><?php } ?>
                        </div>
                      </div>
                    </div>
                </div>
            <?php } ?>
          </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if(count($_SESSION['product_viewed'])>0){ ?>
<div class="sub_main clearfix">
    <div class="wrap_name">
      <div class="name">Sản phẩm đã xem</div>
      <div class="bong_name"></div>
    </div>
    <div class="content_main clearfix">
      <div class="swiper-sp">
        <div class="swiper-wrapper">
          <?php foreach ($_SESSION['product_viewed'] as $spdx) { 
                $d->reset();
                $sql = "select ten_$lang as ten,id,tenkhongdau,photo,giaban,giacu,name_$lang as name from #_product where type='product' and id='$spdx' limit 0,1";
                $d->query($sql);
                $value = $d->fetch_array();
                ?>
                <div class="swiper-slide">
                    <div class="item_dv">
                      <div class="img">
                        <a href="<?=$value['tenkhongdau']?>">
                          <img class="img-responsive lazy" data-src="thumb/262x249/2/<?=_upload_product_l.$value['photo']?>" alt="<?=$value['ten']?>"><div class="icon"></div>
                          <?php if($value['giacu']>0){ ?><div class="sale"><?=get_sale($value['giacu'],$value['giaban'])?></div><?php } ?>
                        </a>
                        <div class="buy" data-id="<?=$value['id']?>"><a href="javascript:void(0);">Thêm vào giỏ hàng</a></div>
                      </div>
                      <div class="info">
                        <div class="name"><h3><a href="<?=$value['tenkhongdau']?>"><?=$value['ten']?></a></h3></div>
                        <div class="price">
                          <span class="giaban"><?php if($value['giaban']>0) echo number_format($value['giaban'],0,',','.').'đ';else echo 'Liên hệ'; ?></span>
                          <?php if($value['giacu']>0){ ?><span class="giacu"><?=number_format($value['giacu'],0,',','.').'đ'; ?></span><?php } ?>
                        </div>
                      </div>
                    </div>
                  
                </div>
            <?php } ?>
          </div>
        </div>
    </div>
</div>
<?php }  ?>