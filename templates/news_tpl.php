<div class="sub_main">
    <div class="wrap_name">
      <div class="name"><h1><?=$title_detail?></h1></div>
      <div class="bong_name"></div>
    </div>
    <div class="content_main">
        <div class="row">
        <?php if($tintuc){?>
            <?php foreach ($tintuc as $key => $value) { ?>
            <div class="col_news col-md-4 col-sm-4 col-xs-6">
                <div class="box_news clearfix">
                    <a class="box_news_img" href="<?=$value['tenkhongdau']?>" title="<?=$value['ten_'.$lang]?>" class="my_glass"><img alt="<?=$value['ten_'.$lang]?>" src="thumb/300x250/1/<?=_upload_baiviet_l.$value['photo']?>" onError="this.src='thumb/300x250/1/images/noimage.png'" class="w100 trans03"/></a>
                    <div class="right_news">
                        <h3 class="box_news_name">
                            <a href="<?=$value['tenkhongdau']?>" title="<?=$value['ten_'.$lang]?>">
                                <?=stripcslashes($value['ten_'.$lang])?>
                            </a>
                        </h3>
                        <div class="box_news_mota"><?=_substr(stripcslashes($value['mota_'.$lang]),150)?></div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="wrap"><div class="auto"><?=$paging?></div></div>
        <?php }else{?><div class="text" style="text-align:center"><b style="color:#F00; font-size: 17px;"><?=_thongbaonull?></b></div><?php }?>
        </div>
    </div>
</div><!--end sub main-->