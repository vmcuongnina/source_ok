<div class="sub_main">
    <div class="wrap_name">
      <div class="name"><h1><?=$title_detail?></h1></div>
      <div class="bong_name"></div>
    </div>
    <div class="content_main">
        <div class="row">
        <?php if($tintuc){?>
            <?php foreach ($tintuc as $key => $value) { ?>
                <div class="col-img col-md-3 col-sm-4 col-xs-6">
                    <div class="item_img">
                        <a class="fcb" data-fancybox="hoatdong" href="<?=_upload_hinhanh_l.$value['photo_vi']?>" data-caption="<?=$value['ten']?>"><img class="img-responsive" alt="<?=$value['ten']?>" src="thumb/300x400/2/<?=_upload_hinhanh_l.$value['photo_vi']?>"/></a>
                    </div>
                </div>
            <?php } ?>
            
            <?php } ?>
        </div>

        <div class="wrap"><div class="auto"><?=$paging?></div></div>
    </div>
</div><!--end sub main-->