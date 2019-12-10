<div class="sub_main">
  <div class="wrap_name">
    <div class="name"><h1><?=$title_detail?></h1></div>
    <div class="bong_name"></div>
  </div>
  <div class="content_main clearfix">
      <div class="row_product">
          <?php
            if(count($product)>0){
            foreach ($product as $key => $value) { ?>
                <div class="col-pro col-md-3 col-sm-4 col-xs-6">
                  <div class="item_dv">
                    <div class="img">
                      <a href="<?=$value['tenkhongdau']?>">
                        <img class="img-responsive lazy" data-src="thumb/product/650x650/2/<?=$value['photo']?>" alt="<?=$value['ten']?>"><div class="icon"></div>
                      </a>
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
          <?php } } ?>
      </div>
  </div><!--content main-->
  <div class="wrap"><div class="auto"><?=$paging?></div></div>
</div><!--end sub main-->

