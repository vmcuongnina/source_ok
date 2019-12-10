<div class="sub_main">
    <div class="wrap_name">
    <div class="name"><h1><?=$title_detail?></h1></div>
    <div class="bong_name"></div>
  </div>
    <div class="content_main clearfix">
        <div class="row_product">
        <?php if(count($album)!=0){?>
            <?php foreach ($album as $key => $value) { ?>

                <div class="col-pro col-md-3 col-sm-4 col-xs-6">
                  <div class="item_dv">
                    <div class="img">
                      <a href="<?=$value['tenkhongdau']?>">
                        <img class="img-responsive" src="thumb/280x220/2/<?=_upload_album_l.$value['photo']?>" alt="<?=$value['ten_'.$lang]?>">
                      </a>
                    </div>
                    <div class="info">
                      <div class="name"><h3><a href="<?=$value['tenkhongdau']?>"><?=$value['ten_'.$lang]?></a></h3></div>
                    </div>
                  </div>
                </div>
            <?php }?>
        <?php } ?>
        </div>
    </div>
    <div class="wrap"><div class="auto"><?=$paging?></div></div>
</div>
